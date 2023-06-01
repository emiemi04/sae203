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

    $sql = "SELECT c.nom, c.prenom, co.dates, co.adresse_livraison, p.libelle
    FROM client c
    JOIN commande co ON c.id_client = co.id_client
    JOIN produit p ON co.id_produit = p.id_produit
    WHERE nom=:leclient";

    $client = $_POST['leclient'];

    $statement = $connection->prepare($sql);
    $statement->bindParam(':leclient', $client, PDO::PARAM_STR);
    $statement->execute();

    $result = $statement->fetchAll();
  } catch(PDOException $error) {
    echo $sql . "<br>" . $error->getMessage();
  }
}
?>
<?php require "templates/header.php"; ?>

<h2 class="ml-8 text-2xl">Historique des commandes</h2><br>

<?php
if (isset($_POST['submit'])) {
  if ($result && $statement->rowCount() > 0) { ?>

    <table class="w-full text-cyan-950">
      <thead class=" border-solid border-t-2 border-b-2 border-cyan-950">
<tr class="">
  <th class="p-3">NOM</th>
  <th class="p-3">PRENOM</th>
  <th class="p-3">PRODUIT</th>
  <th class="p-3">Date de commande</th>
  <th class="p-3">Adresse de livraison</th>
</tr>
      </thead>
      <tbody>
  <?php foreach ($result as $row) { ?>
      <tr class="text-center">
<td class="p-3"><?php echo escape($row["nom"]); ?></td>
<td class="p-3"><?php echo escape($row["prenom"]); ?></td>
<td class="p-3"><?php echo escape($row["libelle"]); ?></td>
<td class="p-3"><?php echo escape($row["dates"]); ?></td>
<td class="p-3"><?php echo escape($row["adresse_livraison"]); ?></td>
      </tr>
    <?php } ?>
      </tbody>
  </table>
  <?php } else { ?>
    > Pas de résultat pour le client : <?php echo escape($_POST['leclient']); ?>.
  <?php }
} ?>

<br>
<form method="post" class="ml-8">

    Choisir un client
  <select name="leclient" id="client" class="border-cyan-900 px-3 py-2 
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