<?php

/**
  * Function to query information based on
  * a parameter: in this case, client.
  *
  */

if (isset($_POST['submit'])) {
  try {
    require "../config.php";
    require "../common.php";

    $connection = new PDO($dsn, $username, $password, $options);

    $sql = "DELETE FROM client
    WHERE nom=:nom";

    $client = $_POST['nom'];

    $statement = $connection->prepare($sql);
    $statement->bindParam(':nom', $client, PDO::PARAM_STR);
    $statement->execute();

    $result = $statement->fetchAll();
  } catch(PDOException $error) {
    echo $sql . "<br>" . $error->getMessage();
  }
}
?>
<?php require "templates/header.php"; ?>

<h2 class="ml-8 text-2xl">Supprimer un client</h2><br>



<form method="post" class="ml-8">

<?php if (isset($_POST['submit']) && $statement) {
    echo "<br><blockquote>Client supprimé avec succès !</blockquote><br>";
}
?>

    Choisir un client
  <select name="nom" id="client" class="border-cyan-900 px-3 py-2 
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
     $sql = "SELECT nom FROM client";
     $result = $conn->query($sql);
     
     // Créer la balise <select> et ses options
     if ($result->num_rows > 0) {
         while ($row = $result->fetch_assoc()) {
             echo '<option value="' . $row['nom'] . '" name="leclient">' . $row['nom'] . '</option>';
         }
     } else {
         echo "Aucun résultat trouvé.";
     }
     ?>
  </select>

    <input type="submit" name="submit" class="px-3 py-2  bg-amber-100 border border-cyan-900 text-cyan-950
    rounded-lg focus:outline-none focus:border-amber-600 focus:ring-1 focus:ring-amber-600 pointer-events-auto" 
    value="Envoyer"/>
</form>
<br>

<a href="index.php" class="m-8 rounded-lg bg-cyan-900 
border border-cyan-950 px-3 py-1 text-amber-200">Retour</a>

<?php require "templates/footer.php"; ?>