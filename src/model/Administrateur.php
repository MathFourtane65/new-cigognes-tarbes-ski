<?php

class Administrateur {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    // Ajoute un nouvel administrateur
    public function addAdministrateur($username, $password) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $this->db->prepare("INSERT INTO administrateurs (username, password) VALUES (:username, :password)");
        $stmt->bindParam(":username", $username);
        $stmt->bindParam(":password", $hashedPassword);

        return $stmt->execute();
    }

    // Vérifie les identifiants d'un administrateur
    public function authenticate($username, $password) {
        $stmt = $this->db->prepare("SELECT password FROM administrateurs WHERE username = :username");
        $stmt->bindParam(":username", $username);
        $stmt->execute();

        $result = $stmt->fetch();

        if ($result && password_verify($password, $result['password'])) {
            return true;  // authentification réussie
        }
        return false; // échec de l'authentification
    }

    // ... Implémentez d'autres méthodes si nécessaire (comme la mise à jour du mot de passe, la récupération d'informations sur un administrateur, etc.)

}

?>
