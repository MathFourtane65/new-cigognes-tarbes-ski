<?php

// Configuration de la base de données
$dbConfig = [
    'host'     => 'localhost',      // L'adresse du serveur de la base de données. Généralement 'localhost'.
    'dbname'   => 'cigognes-tarbes-ski', // Remplacez par le nom de votre base de données.
    'user'     => 'root',       // Remplacez par votre nom d'utilisateur de la base de données.
    'password' => '',       // Remplacez par votre mot de passe de la base de données.
    'charset'  => 'utf8mb4'         // Charset utilisé pour la connexion.
];

// Connexion à la base de données
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

// Retournez la connexion pour qu'elle soit disponible après l'inclusion.
return $db;
?>
