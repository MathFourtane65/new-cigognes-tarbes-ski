<?php

class Sortie
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    // Ajoute une nouvelle sortie
    public function createSortie($nom, $lieu, $date, $date_fin_inscriptions, $places_bus, $heure_depart_bus)
    {
        $stmt = $this->db->prepare("
            INSERT INTO sorties (nom, lieu, date, date_fin_inscriptions, places_bus, heure_depart_bus) 
            VALUES (:nom, :lieu, :date, :date_fin_inscriptions, :places_bus, :heure_depart_bus)
        ");
        $stmt->bindParam(":nom", $nom);
        $stmt->bindParam(":lieu", $lieu);
        $stmt->bindParam(":date", $date);
        $stmt->bindParam(":date_fin_inscriptions", $date_fin_inscriptions);
        $stmt->bindParam(":places_bus", $places_bus);
        $stmt->bindParam(":heure_depart_bus", $heure_depart_bus);

        return $stmt->execute();
    }

    // Read a sortie by id
    public function getSortie($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM sorties WHERE id = :id");
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Update a sortie
    public function updateSortie($id, $nom, $lieu, $date, $date_fin_inscriptions, $places_bus, $heure_depart_bus)
    {
        $stmt = $this->db->prepare("
        UPDATE sorties 
        SET nom = :nom, lieu = :lieu, date = :date, date_fin_inscriptions = :date_fin_inscriptions, places_bus = :places_bus, heure_depart_bus = :heure_depart_bus
        WHERE id = :id
    ");
        $stmt->bindParam(":id", $id);
        $stmt->bindParam(":nom", $nom);
        $stmt->bindParam(":lieu", $lieu);
        $stmt->bindParam(":date", $date);
        $stmt->bindParam(":date_fin_inscriptions", $date_fin_inscriptions);
        $stmt->bindParam(":places_bus", $places_bus);
        $stmt->bindParam(":heure_depart_bus", $heure_depart_bus);
        return $stmt->execute();
    }

    // Delete a sortie
    public function deleteSortie($id)
    {
        $stmt = $this->db->prepare("DELETE FROM sorties WHERE id = :id");
        $stmt->bindParam(":id", $id);
        return $stmt->execute();
    }

    // Récupère toutes les sorties
    public function getAllSorties() {
        $stmt = $this->db->prepare("SELECT * FROM sorties");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    // Récupère toutes les sorties avant l'heure de fin d'isnciption
    public function getAllSortiesBeforeDateFinInscriptions() {
        $stmt = $this->db->prepare("SELECT * FROM sorties WHERE date_fin_inscriptions > NOW()");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    // Récupère toutes les sorties où la date n'est pas passée
    public function getAllSortiesWhereDateNotPassed() {
        $stmt = $this->db->prepare("SELECT * FROM sorties WHERE date > NOW()");
        $stmt->execute();
        return $stmt->fetchAll();
    }
}
