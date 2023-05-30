<?php
/* Utiliser un formulaire pour ajouter des éléments dans la table 'commande'*/

if (isset($_POST['submit'])) {
    require "../config.php";
    require "../common.php";

    try  {
        $connection = new PDO($dsn, $username, $password, $options);
        
        $new_user = array(
            "adresse_livraison" => $_POST['adresse_livraison'],
            "client" => $_POST['client'],
            "produit" => $_POST['produit'],
        );

        $sql = sprintf(
                "INSERT INTO %s (%s) values (%s)",
                "commande",
                implode(", ", array_keys($new_user)),
                ":" . implode(", :", array_keys($new_user))
        );
        
        $statement = $connection->prepare($sql);
        $statement->execute($new_user);
    } catch(PDOException $error) {
        echo $sql . "<br>" . $error->getMesscode_postal();
    }
}
?>

<?php require "templates/header.php"; ?>
<?php if (isset($_POST['submit']) && $statement) { ?>
    <blockquote>Commande effectuée avec succès.</blockquote>
<?php } ?>

<h2>Commander un produit</h2>

<form method="post">
  <label for="adresse_livraison">Adresse livraison</label>
  <input type="text" id="adresse_livraison" name="adresse_livraison">
  
  <label for="client">Nom du client</label>
  <select name="client" id="client">
     <?php
     // Établir une connexion à la base de données
     $servername = "localhost";
     $username = "emilie";
     $password = "passwd";
     $dbname = "magasin";
     
     $conn = new mysqli($servername, $username, $password, $dbname);
     
     // Vérifier la connexion
     if ($conn->connect_error) {
         die("Connexion échouée : " . $conn->connect_error);
     }
     
     // Exécuter une requête SQL pour récupérer les éléments de la table
     $sql = "SELECT id_client, nom FROM client";
     $result = $conn->query($sql);
     
     // Créer la balise <select> et ses options
     if ($result->num_rows > 0) {
         while ($row = $result->fetch_assoc()) {
             echo '<option value="' . $row['id_client'] . '" name="client">' . $row['nom'] . '</option>';
         }
     } else {
         echo "Aucun résultat trouvé.";
     }
     ?>
  </select>

  <label for="produit">Produit</label>
  <select name="produit" id="produit">
  <?php 
  // Exécuter une requête SQL pour récupérer les éléments de la table
$sql = "SELECT id_produit, libelle FROM produit";
$result = $conn->query($sql);

// Créer la balise <select> et ses options
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo '<option value="' . $row['id_produit'] . '" name="produit">' . $row['libelle'] . '</option>';
    }
} else {
    echo "Aucun résultat trouvé.";
}
// Fermer la connexion à la base de données
$conn->close();
?>
  </select>
  <br>
  <input type="submit" name="submit" value="Submit">
</form>

<a href="index.php">Retour</a>

<?php require "templates/footer.php"; ?>