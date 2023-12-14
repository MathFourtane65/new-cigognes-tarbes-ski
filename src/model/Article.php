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

        // if ($result) {
        //     // Split the image paths into an array
        //     $result['image_paths'] = explode(';', $result['image_paths']);
        // }
        if ($result) {
            // Split the image paths into an array and use default image if none is set
            $imagePaths = $result['image_paths'] ? explode(';', $result['image_paths']) : ['/images/uploads/articles/default-article.jpg'];
            $result['image_paths'] = $imagePaths;
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

    public function getArticlesWithPagination($limit, $offset)
    {
        $stmt = $this->db->prepare("
            SELECT 
                a.id, 
                a.titre, 
                a.date, 
                LEFT(a.contenu, 30) as excerpt, 
                GROUP_CONCAT(i.chemin SEPARATOR ';') AS image_paths
            FROM articles a
            LEFT JOIN association_articles_images ai ON a.id = ai.id_article
            LEFT JOIN images i ON ai.id_image = i.id
            GROUP BY a.id
            ORDER BY a.id DESC
            LIMIT :limit OFFSET :offset
        ");
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();
        $articles = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($articles as $key => $article) {
            // Sélectionnez le premier chemin d'image si disponible, sinon utilisez un chemin par défaut
            $articles[$key]['image_paths'] = $article['image_paths'] ? explode(';', $article['image_paths'])[0] : '/images/uploads/articles/default-article.jpg';
        }

        return $articles;
    }

    public function getArticleByIdWithImages($articleId)
    {
        $stmt = $this->db->prepare("
            SELECT 
                a.*, 
                GROUP_CONCAT(i.chemin SEPARATOR ';') AS image_paths
            FROM articles a
            LEFT JOIN association_articles_images ai ON a.id = ai.id_article
            LEFT JOIN images i ON ai.id_image = i.id
            WHERE a.id = :articleId
            GROUP BY a.id
        ");
        $stmt->bindParam(':articleId', $articleId, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            $result['image_paths'] = explode(';', $result['image_paths']);
        }

        return $result;
    }

    public function updateOne($id, $titre, $date, $contenu)
    {
        $stmt = $this->db->prepare("
            UPDATE articles 
            SET titre = :titre, date = :date, contenu = :contenu
            WHERE id = :id
        ");
        $stmt->bindParam(":id", $id);
        $stmt->bindParam(":titre", $titre);
        $stmt->bindParam(":date", $date);
        $stmt->bindParam(":contenu", $contenu);

        return $stmt->execute();
    }
}
