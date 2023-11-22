<?php

class MembreBureau
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    // Ajoute un nouveau membre du bureau
    public function createOneMembreBureau($nom, $prenom, $mail, $telephone, $photo, $role)
    {
        $stmt = $this->db->prepare("
            INSERT INTO membres_bureau (nom, prenom, mail, telephone, photo, role) 
            VALUES (:nom, :prenom, :mail, :telephone, :photo, :role)
        ");
        $stmt->bindParam(":nom", $nom);
        $stmt->bindParam(":prenom", $prenom);
        $stmt->bindParam(":mail", $mail);
        $stmt->bindParam(":telephone", $telephone);
        $stmt->bindParam(":photo", $photo);
        $stmt->bindParam(":role", $role);

        return $stmt->execute();
    }

    // Récupérer tous les membres du bureau
    public function getAllMembresBureau()
    {
        $stmt = $this->db->prepare("SELECT * FROM membres_bureau");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    // Récupérer tous les moniteurs triés par nom
    public function getAllMembresBureauSortByNom()
    {
        $stmt = $this->db->prepare("SELECT * FROM membres_bureau ORDER BY nom");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    // Supprimer un moniteur
    public function deleteOneMembreBureau($id)
    {
        $stmt = $this->db->prepare("DELETE FROM membres_bureau WHERE id = :id");
        $stmt->bindParam(":id", $id);
        return $stmt->execute();
    }

    // Modifier un moniteur
    public function updateOneMembreBureau($id, $nom, $prenom, $mail, $telephone, $photo, $role)
    {
        $stmt = $this->db->prepare("
            UPDATE membres_bureau 
            SET nom = :nom, prenom = :prenom, mail = :mail, telephone = :telephone, photo = :photo, role = :role
            WHERE id = :id
        ");
        $stmt->bindParam(":id", $id);
        $stmt->bindParam(":nom", $nom);
        $stmt->bindParam(":prenom", $prenom);
        $stmt->bindParam(":mail", $mail);
        $stmt->bindParam(":telephone", $telephone);
        $stmt->bindParam(":photo", $photo);
        $stmt->bindParam(":role", $role);
        return $stmt->execute();
    }

    // Récupérer un moniteur
    public function getOneMembreBureau($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM membres_bureau WHERE id = :id");
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function getLastInsertId()
    {
        return $this->db->lastInsertId();
    }
}
