CREATE DATABASE magasin;

use magasin;

DROP TABLE IF EXISTS client ; 
CREATE TABLE client (
    id_client INT AUTO_INCREMENT NOT NULL, 
    nom VARCHAR(50), 
    prenom VARCHAR(50), 
    adresse VARCHAR(50), 
    code_postal INT, 
    PRIMARY KEY (id_client)
    );

DROP TABLE IF EXISTS produit ;
CREATE TABLE produit (
    id_produit INT AUTO_INCREMENT NOT NULL, 
    code_produit INT, 
    libelle VARCHAR(50),
    prix_unitaire INT, 
    PRIMARY KEY (id_produit)
    ) ;


DROP TABLE IF EXISTS commande ; 
    CREATE TABLE commande (
    id_commande INT AUTO_INCREMENT NOT NULL,
    dates TIMESTAMP,
    adresse_livraison VARCHAR(50), 
    id_client INT,
    id_produit INT,
    PRIMARY KEY (id_commande)
    );