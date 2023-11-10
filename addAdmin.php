<?php
// addAdmin.php

require 'config.php'; // Assurez-vous d'avoir le fichier de configuration correct.
require 'models/Administrateur.php';

// Initialisez la connexion à la base de données
// (Assurez-vous que la configuration est correcte dans config.php)
$dbConfig = $config['database'];
try {
    $db = new PDO(
        "mysql:host={$dbConfig['host']};dbname={$dbConfig['dbname']};charset={$dbConfig['charset']}",
        $dbConfig['user'],
        $dbConfig['password']
    );
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}

$admin = new Administrateur($db);

// Si le formulaire est soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Ajoutez une vérification ici pour éviter que le formulaire ne soit soumis avec des champs vides ou d'autres validations si nécessaire
    if(!empty($username) && !empty($password)) {
        $admin->addAdministrateur($username, $password);
        echo "Administrateur ajouté avec succès!";
    } else {
        echo "Veuillez remplir tous les champs!";
    }
}
?>

<form method="post">
    <label for="username">Nom d'utilisateur :</label>
    <input type="text" id="username" name="username">

    <label for="password">Mot de passe :</label>
    <input type="password" id="password" name="password">

    <input type="submit" value="Ajouter">
</form>
