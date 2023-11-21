<?php

class Licencie {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    // Ajoute un nouveau licencié
    public function addLicencie($nom, $prenom, $date_naissance, $mail, $telephone, $adresse, $code_postal, $ville, $niveau, $password, $identifiant) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $this->db->prepare("
            INSERT INTO licencies (nom, prenom, date_naissance, mail, telephone, adresse, code_postal, ville, niveau, password, identifiant) 
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

    // Authentifie un licencié
    public function authenticate($identifiant, $password) {
        $stmt = $this->db->prepare("SELECT id, password FROM licencies WHERE identifiant = :identifiant");
        $stmt->bindParam(":identifiant", $identifiant);
        $stmt->execute();

        $result = $stmt->fetch();

        if ($result && password_verify($password, $result['password'])) {
            return $result;  // authentification réussie
        }
        return false; // échec de l'authentification
    }

    // Récupère les informations d'un licencié
    public function getLicencie($id) {
        $stmt = $this->db->prepare("SELECT * FROM licencies WHERE id = :id");
        $stmt->bindParam(":id", $id);
        $stmt->execute();

        return $stmt->fetch();
    }

    // Met à jour les informations d'un licencié
    public function updateLicencieByAdmin($id, $nom, $prenom, $date_naissance, $mail, $telephone, $adresse, $code_postal, $ville) {
        $stmt = $this->db->prepare("
            UPDATE licencies 
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

    // Supprime un licencié
    public function deleteLicencie($id) {
        $stmt = $this->db->prepare("DELETE FROM licencies WHERE id = :id");
        $stmt->bindParam(":id", $id);        
        return $stmt->execute();
    }

    // Récupère tous les licenciés
    public function getAllLicencies() {
        $stmt = $this->db->prepare("SELECT * FROM licencies");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    // Récupère tous les licenciés triés par le nom de famille
    public function getAllLicenciesSortedByLastName() {
        $stmt = $this->db->prepare("SELECT * FROM licencies ORDER BY nom ASC");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    // Récupère tous les licenciés qui ont un mail
    public function getAllLicenciesWithMail() {
        $stmt = $this->db->prepare("SELECT * FROM licencies WHERE mail IS NOT NULL AND mail != '' ORDER BY nom ASC");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getLastInsertId() {
        return $this->db->lastInsertId();
    }
}

?>
