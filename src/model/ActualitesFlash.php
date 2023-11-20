<?php

class ActualitesFlash
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    // Ajoute une nouvelle actualite flash
    public function createActualitesFlash($contenu, $cache)
    {
        $stmt = $this->db->prepare("
            INSERT INTO actualites_flash (contenu, cache) 
            VALUES (:contenu, :cache)
        ");
        $stmt->bindParam(":contenu", $contenu);
        $stmt->bindValue(":cache", $cache);

        return $stmt->execute();
    }

    // Read a actualite flash by id
    public function getOneActualitesFlash($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM actualites_flash WHERE id = :id");
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Update a actualite flash
    public function updateActualitesFlash($id, $contenu, $cache)
    {
        $stmt = $this->db->prepare("
        UPDATE actualites_flash 
        SET contenu = :contenu, cache = :cache
        WHERE id = :id
    ");
        $stmt->bindParam(":id", $id);
        $stmt->bindParam(":contenu", $contenu);
        $stmt->bindValue(":cache", $cache);
        return $stmt->execute();
    }

    // Récupère toutes les actualites flash
    public function getAllActualitesFlash()
    {
        $stmt = $this->db->prepare("SELECT * FROM actualites_flash");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getLashActualitesFlash()
    {
        $stmt = $this->db->prepare("SELECT * FROM actualites_flash ORDER BY id DESC LIMIT 1");
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

}
