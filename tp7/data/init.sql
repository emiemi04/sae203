CREATE DATABASE magasin;

use magasin;

CREATE TABLE clients (
    id_client INT() UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(30) NOT NULL,
    prenom VARCHAR(30) NOT NULL,
    adresse VARCHAR(50) NOT NULL,
    code_postal INT(),
    ville VARCHAR(50)
  );

  CREATE TABLE produit (
    id_produit INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    code_produit INT(20),
    libelle VARCHAR(30) NOT NULL,
    prix_unitaire INT(20)
  );

  CREATE TABLE commande (
    id_commande INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    date
    produit_id INT,
    client_id INT,
    produit_id INT,
    FOREIGN KEY (client_id) REFERENCES clients(id_client),
    FOREIGN KEY (produit_id) REFERENCES produit(id_produit)
);