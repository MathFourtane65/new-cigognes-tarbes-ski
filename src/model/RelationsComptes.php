<?php

class RelationsComptes
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    // Enregistre une nouvelle relation
    public function addRelation($idParent, $idEnfant)
    {
        $stmt = $this->db->prepare("INSERT INTO relations_comptes (id_parent, id_enfant) VALUES (:id_parent, :id_enfant)");
        $stmt->bindParam(":id_parent", $idParent);
        $stmt->bindParam(":id_enfant", $idEnfant);
        return $stmt->execute();
    }

    // Récupère toutes les relations parent-enfant
    public function getAllRelationsWithNomAndPrenom()
    {
        $stmt = $this->db->prepare("
                SELECT rc.id, p.nom AS nom_parent, p.prenom AS prenom_parent, e.nom AS nom_enfant, e.prenom AS prenom_enfant 
                FROM relations_comptes rc
                INNER JOIN licencies p ON rc.id_parent = p.id
                INNER JOIN licencies e ON rc.id_enfant = e.id
                ORDER BY p.nom ASC, p.prenom ASC;
            ");
        $stmt->execute();
        return $stmt->fetchAll();
    }


    // Met à jour une relation existante
    public function updateRelation($idRelation, $idParent, $idEnfant)
    {
        $stmt = $this->db->prepare("UPDATE relations_comptes SET id_parent = :id_parent WHERE id = :id_relation");
        $stmt->bindParam(":id_relation", $idRelation);
        $stmt->bindParam(":id_parent", $idParent);
        return $stmt->execute();
    }

    // Récupère l'ID du parent avec l'ID de l'enfant
    public function getParentIdByChildId($idEnfant)
    {
        $stmt = $this->db->prepare("SELECT id_parent FROM relations_comptes WHERE id_enfant = :id_enfant");
        $stmt->bindParam(":id_enfant", $idEnfant);
        $stmt->execute();
        return $stmt->fetch();
    }

    // Supprime une relation
    public function deleteRelation($idRelation)
    {
        $stmt = $this->db->prepare("DELETE FROM relations_comptes WHERE id = :id_relation");
        $stmt->bindParam(":id_relation", $idRelation);
        return $stmt->execute();
    }

// Récupère tous les enfants d'un parent avec toutes les informations nécessaires
public function getChildrenByParentId($idParent)
{
    $stmt = $this->db->prepare("
        SELECT e.id AS id_enfant, e.nom AS nom_enfant, e.prenom AS prenom_enfant, e.date_naissance AS date_naissance_enfant, e.mail AS mail_enfant, e.telephone AS telephone_enfant, e.code_postal AS code_postal_enfant, e.ville AS ville_enfant, e.adresse AS adresse_enfant
        FROM relations_comptes rc
        INNER JOIN licencies e ON rc.id_enfant = e.id
        WHERE rc.id_parent = :id_parent
        ORDER BY e.nom ASC, e.prenom ASC;
    ");
    $stmt->bindParam(":id_parent", $idParent);
    $stmt->execute();
    return $stmt->fetchAll();
}

    // Récupère tous les parents d'un enfant
    public function getParentsByChildId($idEnfant)
    {
        $stmt = $this->db->prepare("
                SELECT rc.id, p.nom AS nom_parent, p.prenom AS prenom_parent, e.nom AS nom_enfant, e.prenom AS prenom_enfant 
                FROM relations_comptes rc
                INNER JOIN licencies p ON rc.id_parent = p.id
                INNER JOIN licencies e ON rc.id_enfant = e.id
                WHERE rc.id_enfant = :id_enfant
                ORDER BY p.nom ASC, p.prenom ASC;
            ");
        $stmt->bindParam(":id_enfant", $idEnfant);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    // ... Ajouter d'autres méthodes CRUD si nécessaire ...
}
