<?php

class LicencieImporte
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    // Ajoute un nouveau licencié "importé"
    public function createOne($nom, $prenom, $date_naissance, $mail, $telephone, $adresse, $code_postal, $ville, $niveau, $password, $identifiant)
    {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $this->db->prepare("
            INSERT INTO licencies_importes (nom, prenom, date_naissance, mail, telephone, adresse, code_postal, ville, niveau, password, identifiant) 
            VALUES (:nom, :prenom, :date_naissance, :mail, :telephone, :adresse, :code_postal, :ville, :niveau, :password, :identifiant)
        ");
        $stmt->bindParam(":nom", $nom);
        $stmt->bindParam(":prenom", $prenom);
        $stmt->bindParam(":date_naissance", $date_naissance);
        $stmt->bindParam(":mail", $mail);
        $stmt->bindParam(":telephone", $telephone);
        $stmt->bindParam(":adresse", $adresse);
        $stmt->bindParam(":code_postal", $code_postal);
        $stmt->bindParam(":ville", $ville);
        $stmt->bindParam(":niveau", $niveau);
        $stmt->bindParam(":password", $hashedPassword);
        $stmt->bindParam(":identifiant", $identifiant);

        return $stmt->execute();
    }


    // Récupère les informations d'un licencié "importé"
    public function getOne($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM licencies_importes WHERE id = :id");
        $stmt->bindParam(":id", $id);
        $stmt->execute();

        return $stmt->fetch();
    }

    // Met à jour les informations d'un licencié "importé"
    public function updateOneByAdmin($id, $nom, $prenom, $date_naissance, $mail, $telephone, $adresse, $code_postal, $ville)
    {
        $stmt = $this->db->prepare("
            UPDATE licencies_importes 
            SET nom = :nom, prenom = :prenom, date_naissance = :date_naissance, mail = :mail, 
            telephone = :telephone, adresse = :adresse, code_postal = :code_postal, ville = :ville
            WHERE id = :id
        ");
        $stmt->bindParam(":id", $id);
        $stmt->bindParam(":nom", $nom);
        $stmt->bindParam(":prenom", $prenom);
        $stmt->bindParam(":date_naissance", $date_naissance);
        $stmt->bindParam(":mail", $mail);
        $stmt->bindParam(":telephone", $telephone);
        $stmt->bindParam(":adresse", $adresse);
        $stmt->bindParam(":code_postal", $code_postal);
        $stmt->bindParam(":ville", $ville);

        return $stmt->execute();
    }

    // Supprime un licencié "importé"
    public function deleteOne($id)
    {
        $stmt = $this->db->prepare("DELETE FROM licencies_importes WHERE id = :id");
        $stmt->bindParam(":id", $id);
        return $stmt->execute();
    }

    // Met à jour le mot de passe d'un licencié
    public function resetPassword($id, $newPassword)
    {
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

        $stmt = $this->db->prepare("
            UPDATE licencies_importes 
            SET password = :password
            WHERE id = :id
        ");
        $stmt->bindParam(":id", $id);
        $stmt->bindParam(":password", $hashedPassword);

        return $stmt->execute();
    }

    // Récupère tous les licenciés "importés"
    public function getAll()
    {
        $stmt = $this->db->prepare("SELECT * FROM licencies_importes");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    // Récupère tous les licenciés "importés" triés par le nom de famille
    public function getAllSortedByLastName()
    {
        $stmt = $this->db->prepare("SELECT * FROM licencies_importes ORDER BY nom ASC");
        $stmt->execute();
        return $stmt->fetchAll();
    }


    public function getLastInsertId()
    {
        return $this->db->lastInsertId();
    }
}
