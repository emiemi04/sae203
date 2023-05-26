CREATE DATABASE magasin;

use magasin;

DROP TABLE IF EXISTS Client ; 
CREATE TABLE Client (id_client_Client INT AUTO_INCREMENT NOT NULL, 
nom_Client VARCHAR(50), 
prenom_Client VARCHAR(50), 
adresse_Client VARCHAR(50), 
code_postal_Client INT, 
PRIMARY KEY (id_client_Client)) ENGINE=InnoDB;


DROP TABLE IF EXISTS Commande ; 
CREATE TABLE Commande (id_commande_Commande INT AUTO_INCREMENT NOT NULL,
dates_Commande TIMESTAMP,
adresse_livraison_Commande VARCHAR, 
id_client_Client **NOT FOUND**,
id_produit_Produit **NOT FOUND**,
PRIMARY KEY (id_commande_Commande)) ENGINE=InnoDB;



DROP TABLE IF EXISTS Produit ;
CREATE TABLE Produit (id_produit_Produit INT AUTO_INCREMENT NOT NULL, 
code_produit_Produit INT, 
libelle_Produit VARCHAR,
prix_unitaire_Produit INT, 
PRIMARY KEY (id_produit_Produit)) ENGINE=InnoDB;



ALTER TABLE Commande ADD CONSTRAINT FK_Commande_id_client_Client FOREIGN KEY (id_client_Client) REFERENCES Client (id_client_Client); 
ALTER TABLE Commande ADD CONSTRAINT FK_Commande_id_produit_Produit FOREIGN KEY (id_produit_Produit) REFERENCES Produit (id_produit_Produit); 