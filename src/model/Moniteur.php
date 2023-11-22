<?php 

class Moniteur
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    // Ajoute un nouveau moniteur
    public function createOneMoniteur($nom, $prenom, $mail, $telephone, $photo, $niveau)
    {
        $stmt = $this->db->prepare("
            INSERT INTO moniteurs (nom, prenom, mail, telephone, photo, niveau) 
            VALUES (:nom, :prenom, :mail, :telephone, :photo, :niveau)
        ");
        $stmt->bindParam(":nom", $nom);
        $stmt->bindParam(":prenom", $prenom);
        $stmt->bindParam(":mail", $mail);
        $stmt->bindParam(":telephone", $telephone);
        $stmt->bindParam(":photo", $photo);
        $stmt->bindParam(":niveau", $niveau);
        
        return $stmt->execute();
    }

    // Récupérer tous les moniteurs
    public function getAllMoniteurs()
    {
        $stmt = $this->db->prepare("SELECT * FROM moniteurs");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    // Récupérer tous les moniteurs triés par nom
    public function getAllMoniteursSortByNom()
    {
        $stmt = $this->db->prepare("SELECT * FROM moniteurs ORDER BY nom");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    // Supprimer un moniteur
    public function deleteOneMoniteur($id)
    {
        $stmt = $this->db->prepare("DELETE FROM moniteurs WHERE id = :id");
        $stmt->bindParam(":id", $id);
        return $stmt->execute();
    }

    // Modifier un moniteur
    public function updateOneMoniteur($id, $nom, $prenom, $mail, $telephone, $photo, $niveau)
    {
        $stmt = $this->db->prepare("
            UPDATE moniteurs 
            SET nom = :nom, prenom = :prenom, mail = :mail, telephone = :telephone, photo = :photo, niveau = :niveau
            WHERE id = :id
        ");
        $stmt->bindParam(":id", $id);
        $stmt->bindParam(":nom", $nom);
        $stmt->bindParam(":prenom", $prenom);
        $stmt->bindParam(":mail", $mail);
        $stmt->bindParam(":telephone", $telephone);
        $stmt->bindParam(":photo", $photo);
        $stmt->bindParam(":niveau", $niveau);
        return $stmt->execute();
    }

    // Récupérer un moniteur
    public function getOneMoniteur($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM moniteurs WHERE id = :id");
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function getLastInsertId()
    {
        return $this->db->lastInsertId();
    }


}