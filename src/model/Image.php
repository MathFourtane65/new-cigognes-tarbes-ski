<?php 

class Image
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    // Ajoute une nouvelle image
    public function createOneImage($chemin)
    {
        $stmt = $this->db->prepare("
            INSERT INTO images (chemin) 
            VALUES (:chemin)
        ");
        $stmt->bindParam(":chemin", $chemin);

        return $stmt->execute();
    }

    // Récupérer toutes les images
    public function getAllImages()
    {
        $stmt = $this->db->prepare("SELECT * FROM images");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getLastInsertId()
    {
        return $this->db->lastInsertId();
    }


}