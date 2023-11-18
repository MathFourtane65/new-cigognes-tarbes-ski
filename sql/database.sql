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

CREATE TABLE sorties (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(255) NOT NULL,
    lieu VARCHAR(255) NOT NULL,
    date DATE NOT NULL,
    date_fin_inscriptions DATETIME,
    places_bus INT,
    heure_depart_bus TIME NOT NULL
);

CREATE TABLE relations_comptes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_parent INT NOT NULL,
    id_enfant INT NOT NULL,
    FOREIGN KEY (id_parent) REFERENCES licencies(id),
    FOREIGN KEY (id_enfant) REFERENCES licencies(id)
);

ALTER TABLE relations_comptes
ADD CONSTRAINT fk_relations_comptes_parent
FOREIGN KEY (id_parent) REFERENCES licencies(id)
ON DELETE CASCADE;

ALTER TABLE relations_comptes
ADD CONSTRAINT fk_relations_comptes_enfant
FOREIGN KEY (id_enfant) REFERENCES licencies(id)
ON DELETE CASCADE;


CREATE TABLE articles (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titre VARCHAR(255) NOT NULL,
    date DATE NOT NULL,
    contenu TEXT NOT NULL
);

CREATE TABLE images (
    id INT AUTO_INCREMENT PRIMARY KEY,
    chemin VARCHAR(255) NOT NULL
);

CREATE TABLE association_articles_images (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_article INT,
    id_image INT,
    FOREIGN KEY (id_article) REFERENCES articles(id) ON DELETE CASCADE,
    FOREIGN KEY (id_image) REFERENCES images(id) ON DELETE CASCADE
);




