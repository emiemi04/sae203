# sae203-tp7

Page web créer en PHP, reliée à une base de donnée SQL.

Vous trouverez les feuilles de codes de notre page intitulé "Système simple de gestion d'un magasin"

Ceci est une interface web extrèmement simple afin de :
- créer un client
- créer un produit
- créer une commande
- afficher l'historique des commandes d'un client
- supprimer un client

Dossier tp7 : codes sources
  -> **data** : créer la base de donnée SQL (test.sql)
  
  -> **node_modules** : framework Tailwind
  
  -> **src** : interface web
           - page d'acceuil (index.php)
           - créer un client (create.php)
           - créer un produit (produit.php)
           - faire une commande (read.php)
           - voir l'historique des livraisons (adresse_livraison.php)
           - supprimer un client (suppclient.php)   
         -> **templates** : entête (header.php) et bas de page (footer.php) du site
         
  - prendre en compte les caractères spéciaux dans HTML (common.php)
  - se connecter à la base de donnée (config.php)
  - créer la base de donnée (install.php)
  - fichiers js de Tailwind
