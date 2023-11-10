CREATE DATABASE `cigognes-tarbes-ski` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;


CREATE TABLE administrateurs (
    id INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(191) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
);

CREATE TABLE licencies (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(255) NOT NULL,
    prenom VARCHAR(255) NOT NULL,
    date_naissance DATE NOT NULL,
    mail VARCHAR(255),
    telephone VARCHAR(15),
    adresse TEXT,
    code_postal VARCHAR(10),
    ville VARCHAR(255),
    niveau VARCHAR(50),
    password VARCHAR(255),
    identifiant VARCHAR(255)
);

