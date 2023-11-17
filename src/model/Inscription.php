<?php

class Inscription {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    // Enregistre une nouvelle inscription
    public function addInscription($licencie_id, $sortie_id, $bus, $lieu_bus, $montant_licencie, $paye) {
        $stmt = $this->db->prepare("
            INSERT INTO inscriptions (licencie_id, sortie_id, bus, lieu_bus, montant_licencie, paye) 
            VALUES (:licencie_id, :sortie_id, :bus, :lieu_bus, :montant_licencie, :paye)
        ");
        $stmt->bindParam(":licencie_id", $licencie_id);
        $stmt->bindParam(":sortie_id", $sortie_id);
        $stmt->bindParam(":bus", $bus);
        $stmt->bindParam(":lieu_bus", $lieu_bus);
        $stmt->bindParam(":montant_licencie", $montant_licencie);
        $stmt->bindParam(":paye", $paye);

        return $stmt->execute();
    }

    public function getAllInscriptionBySortie($sortie_id) {
        $stmt = $this->db->prepare("SELECT * FROM inscriptions WHERE sortie_id = :sortie_id");
        $stmt->bindParam(":sortie_id", $sortie_id);
        $stmt->execute();

        return $stmt->fetchAll();
    }

    // ... Ajouter d'autres méthodes CRUD si nécessaire ...
}
?>
