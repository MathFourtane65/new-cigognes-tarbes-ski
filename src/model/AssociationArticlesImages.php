<?php 

class AssociationArticlesImages
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    // Ajoute une nouvelle association
    public function createOneAssociation($id_article, $id_image)
    {
        $stmt = $this->db->prepare("
            INSERT INTO association_articles_images (id_article, id_image) 
            VALUES (:id_article, :id_image)
        ");
        $stmt->bindParam(":id_article", $id_article);
        $stmt->bindParam(":id_image", $id_image);

        return $stmt->execute();
    }

    // Récupérer toutes les associations
    public function getAllAssociations()
    {
        $stmt = $this->db->prepare("SELECT * FROM association_articles_images");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    // Récupérer toutes les associations d'un article
    public function getAllAssociationsByArticle($id_article)
    {
        $stmt = $this->db->prepare("SELECT * FROM association_articles_images WHERE id_article = :id_article");
        $stmt->bindParam(":id_article", $id_article);
        $stmt->execute();
        return $stmt->fetchAll();
    }

}
