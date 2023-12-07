<?php

class Inscription
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    // Enregistre une nouvelle inscription
    public function addInscription($licencie_id, $sortie_id, $bus, $lieu_bus, $montant_licencie, $paye, $commentaireLicencie, $commentaireAdmin)
    {
        $stmt = $this->db->prepare("
            INSERT INTO inscriptions (licencie_id, sortie_id, bus, lieu_bus, montant_licencie, paye, commentaire_licencie, commentaire_admin) 
            VALUES (:licencie_id, :sortie_id, :bus, :lieu_bus, :montant_licencie, :paye, :commentaire_licencie, :commentaire_admin)
        ");
        $stmt->bindParam(":licencie_id", $licencie_id);
        $stmt->bindParam(":sortie_id", $sortie_id);
        $stmt->bindParam(":bus", $bus);
        $stmt->bindParam(":lieu_bus", $lieu_bus);
        $stmt->bindParam(":montant_licencie", $montant_licencie);
        $stmt->bindParam(":paye", $paye);
        $stmt->bindParam(":commentaire_licencie", $commentaireLicencie);
        $stmt->bindParam(":commentaire_admin", $commentaireAdmin);

        return $stmt->execute();
    }

    public function getAllInscriptionBySortie($sortie_id)
    {
        $stmt = $this->db->prepare("SELECT * FROM inscriptions WHERE sortie_id = :sortie_id");
        $stmt->bindParam(":sortie_id", $sortie_id);
        $stmt->execute();

        return $stmt->fetchAll();
    }

    // recupére tous les isncriptions d'un lciencié avec en plus les infos du licencié (id, nom, prenom, date de naissane, mail, telephone)
    public function getAllInscriptionBySortieWithLicencie($sortie_id)
    {
        $stmt = $this->db->prepare("
            SELECT i.*, l.id AS licencie_id, l.nom, l.prenom, l.date_naissance, l.mail, l.telephone
            FROM inscriptions i
            INNER JOIN licencies l ON i.licencie_id = l.id
            WHERE i.sortie_id = :sortie_id
        ");
        $stmt->bindParam(":sortie_id", $sortie_id);
        $stmt->execute();

        return $stmt->fetchAll();
    }

    public function getAllByLicencie($licencie_id)
    {
        $stmt = $this->db->prepare("SELECT * FROM inscriptions WHERE licencie_id = :licencie_id");
        $stmt->bindParam(":licencie_id", $licencie_id);
        $stmt->execute();

        return $stmt->fetchAll();
    }

    public function getByLicencieAndSortie($licencie_id, $sortie_id)
    {
        $stmt = $this->db->prepare("SELECT * FROM inscriptions WHERE licencie_id = :licencie_id AND sortie_id = :sortie_id");
        $stmt->bindParam(":licencie_id", $licencie_id);
        $stmt->bindParam(":sortie_id", $sortie_id);
        $stmt->execute();

        return $stmt->fetch();
    }

    // Vérifie si un licencié est déjà inscrit à une sortie donnée
    public function isLicencieInscrit($licencie_id, $sortie_id)
    {
        $stmt = $this->db->prepare("SELECT COUNT(*) FROM inscriptions WHERE licencie_id = :licencie_id AND sortie_id = :sortie_id");
        $stmt->bindParam(":licencie_id", $licencie_id);
        $stmt->bindParam(":sortie_id", $sortie_id);
        $stmt->execute();

        return $stmt->fetchColumn() > 0;
    }

    public function countReservedBusPlaces($sortie_id)
    {
        $stmt = $this->db->prepare("SELECT COUNT(*) FROM inscriptions WHERE sortie_id = :sortie_id AND bus = 1");
        $stmt->bindParam(":sortie_id", $sortie_id);
        $stmt->execute();

        return $stmt->fetchColumn();
    }

    // ... Ajouter d'autres méthodes CRUD si nécessaire ...
}
