<?php

class EvenementModel
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    // Ajoute un nouvel évènement
    public function createOneEvenement($date, $nom, $lieu)
    {
        $stmt = $this->db->prepare("
            INSERT INTO evenements (date, nom, lieu) 
            VALUES (:date, :nom, :lieu)
        ");
        $stmt->bindParam(":date", $date);
        $stmt->bindParam(":nom", $nom);
        $stmt->bindParam(":lieu", $lieu);

        return $stmt->execute();
    }

    // Récupère tous les évènements triés par date
    public function getAllEvenementsSortByDate()
    {
        $stmt = $this->db->prepare("
            SELECT * FROM evenements
            ORDER BY date
        ");

        $stmt->execute();
        return $stmt->fetchAll();
    }

    // Récupère un évènement par son id
    public function getOneEvenement($id)
    {
        $stmt = $this->db->prepare("
            SELECT * FROM evenements
            WHERE id = :id
        ");
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return $stmt->fetch();
    }

    // Met à jour un évènement
    public function updateOneEvenement($id, $date, $nom, $lieu)
    {
        $stmt = $this->db->prepare("
            UPDATE evenements
            SET date = :date, nom = :nom, lieu = :lieu
            WHERE id = :id
        ");
        $stmt->bindParam(":id", $id);
        $stmt->bindParam(":date", $date);
        $stmt->bindParam(":nom", $nom);
        $stmt->bindParam(":lieu", $lieu);

        return $stmt->execute();
    }

    // Supprime un évènement
    public function deleteOneEvenement($id)
    {
        $stmt = $this->db->prepare("
            DELETE FROM evenements
            WHERE id = :id
        ");
        $stmt->bindParam(":id", $id);

        return $stmt->execute();
    }

    // Récupère le dernier id inséré
    public function getLastInsertId()
    {
        return $this->db->lastInsertId();
    }
}
