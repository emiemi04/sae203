<?php
/* Utiliser un formulaire pour ajouter des éléments dans la table 'commande'*/

if (isset($_POST['submit'])) {
    require "../config.php";
    require "../common.php";

    try  {
        $connection = new PDO($dsn, $username, $password, $options);
        
        $new_user = array(
            "adresse_livraison" => $_POST['adresse_livraison'],
            "id_client" => $_POST['id_client'],
            "id_produit" => $_POST['id_produit'],
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

<h2 class="ml-8 text-3xl text-sky-950">Commander un produit</h2><br>

<form method="post" class="grid gap-2 place-content-center">

<?php if (isset($_POST['submit']) && $statement) {
    echo "<br><blockquote>Commande effectuée avec succès !</blockquote><br>";
}
?>

  Nom du client
  <select name="id_client" id="client" class="border-cyan-900 px-3 py-2 
    rounded-lg focus:outline-none focus:border-amber-600 focus:ring-1 focus:ring-amber-600">
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
     
     // Créer la balise <option> et ses options
     if ($result->num_rows > 0) {
         while ($row = $result->fetch_assoc()) {
             echo '<option value="' . $row['id_client'] . '" name="id_client">' . $row['nom'] . '</option>';
         }
     } else {
         echo "Aucun résultat trouvé.";
     }
     ?>
  </select>

  Produit
  <select name="id_produit" id="produit" class="border-cyan-900 px-3 py-2 
    rounded-lg focus:outline-none focus:border-amber-600 focus:ring-1 focus:ring-amber-600">
  <?php 
  // Exécuter une requête SQL pour récupérer les éléments de la table
$sql = "SELECT id_produit, libelle FROM produit";
$result = $conn->query($sql);

// Créer la balise <option> et ses options
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo '<option value="' . $row['id_produit'] . '" name="id_produit">' . $row['libelle'] . '</option>';
    }
} else {
    echo "Aucun résultat trouvé.";
}
?>
  </select>

    Adresse de livraison
    <input type="text" name="adresse_livraison" placeholder="Adresse de livraison" class="border border-cyan-900 px-3 py-2 
    rounded-lg focus:outline-none focus:border-amber-600 focus:ring-1 focus:ring-amber-600"/>

    <input type="submit" name="submit" class="px-3 py-2  bg-amber-100 border border-cyan-900 text-cyan-950
    rounded-lg focus:outline-none focus:border-amber-600 focus:ring-1 focus:ring-amber-600" 
    value="Envoyer"/>

</form>



<a href="index.php" class="m-8 rounded-lg bg-cyan-900 
border border-cyan-950 px-3 py-1 text-amber-200">Retour</a>

<?php require "templates/footer.php"; ?>