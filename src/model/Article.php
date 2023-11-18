<?php

class Article
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    // Ajoute un nouvel article
    public function createOneArticle($titre, $date, $contenu)
    {
        $stmt = $this->db->prepare("
            INSERT INTO articles (titre, date, contenu) 
            VALUES (:titre, :date, :contenu)
        ");
        $stmt->bindParam(":titre", $titre);
        $stmt->bindParam(":date", $date);
        $stmt->bindParam(":contenu", $contenu);

        return $stmt->execute();
    }

    // Récupérer tous les articles
    public function getAllArticles()
    {
        $stmt = $this->db->prepare("SELECT * FROM articles");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getLastInsertId()
    {
        return $this->db->lastInsertId();
    }


    // Récupérer tous les articles avec le nombre d'images associées
    public function getAllArticlesWithImageCount()
    {
        $stmt = $this->db->prepare("
            SELECT 
                a.id, 
                a.titre, 
                a.date, 
                a.contenu, 
                COUNT(ai.id_image) as image_count
            FROM articles a
            LEFT JOIN association_articles_images ai ON a.id = ai.id_article
            GROUP BY a.id
        ");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getLastArticleWithImages()
    {
        $stmt = $this->db->prepare("
        SELECT 
            a.id, 
            a.titre, 
            a.date, 
            a.contenu, 
            GROUP_CONCAT(i.chemin SEPARATOR ';') AS image_paths
        FROM articles a
        LEFT JOIN association_articles_images ai ON a.id = ai.id_article
        LEFT JOIN images i ON ai.id_image = i.id
        WHERE a.id = (SELECT MAX(id) FROM articles)
        GROUP BY a.id
    ");
        $stmt->execute();
        $result = $stmt->fetch();

        if ($result) {
            // Split the image paths into an array
            $result['image_paths'] = explode(';', $result['image_paths']);
        }

        return $result;
    }

    public function deleteArticleWithImages($articleId)
    {
        // D'abord, obtenir les chemins des images à supprimer
        $stmt = $this->db->prepare("
            SELECT images.chemin 
            FROM images 
            JOIN association_articles_images ON images.id = association_articles_images.id_image 
            WHERE association_articles_images.id_article = :articleId
        ");
        $stmt->bindParam(":articleId", $articleId);
        $stmt->execute();
        $images = $stmt->fetchAll();

        // // Ensuite, supprimer les associations
        // $stmt = $this->db->prepare("DELETE FROM association_articles_images WHERE id_article = :articleId");
        // $stmt->bindParam(":articleId", $articleId);
        // $stmt->execute();

        // // Puis, supprimer les images
        // $stmt = $this->db->prepare("DELETE FROM images WHERE id IN (SELECT id_image FROM association_articles_images WHERE id_article = :articleId)");
        // $stmt->bindParam(":articleId", $articleId);
        // $stmt->execute();

        // Supprimer d'abord les associations
        $stmt = $this->db->prepare("DELETE FROM association_articles_images WHERE id_article = :articleId");
        $stmt->bindParam(":articleId", $articleId);
        $stmt->execute();

        // Ensuite, récupérer les IDs des images liées à l'article pour les supprimer
        $imageIdsToDelete = array_column($images, 'id');

        // Supprimer les images
        $stmt = $this->db->prepare("DELETE FROM images WHERE id IN (:imageIds)");
        $stmt->bindParam(":imageIds", implode(',', $imageIdsToDelete));
        $stmt->execute();


        // Enfin, supprimer l'article
        $stmt = $this->db->prepare("DELETE FROM articles WHERE id = :articleId");
        $stmt->bindParam(":articleId", $articleId);
        $stmt->execute();

        // Retourner les chemins des images pour suppression du système de fichiers
        return array_column($images, 'chemin');
    }
}
