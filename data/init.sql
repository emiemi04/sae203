CREATE DATABASE magasin;

use magasin;

CREATE TABLE clients (
    id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(30) NOT NULL,
    prenom VARCHAR(30) NOT NULL,
    adresse VARCHAR(50) NOT NULL,
    code_postal INT(3),
    ville VARCHAR(50)
  );

  CREATE TABLE produit (
    id_produit INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    code_produit INT(20),
    libelle VARCHAR(30) NOT NULL,
    prix_unitaire INT(20)
  );