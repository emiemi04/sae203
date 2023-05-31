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

    $sql = "SELECT nom, prenom, libelle, adresse_livraison, dates
    FROM client c
    JOIN produit p
    LEFT JOIN commande co ON co.id_client = c.id_client and p.id_produit = co.id_produit
    ORDER BY c.id_client
    ";

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

<?php
if (isset($_POST['submit'])) {
  if ($result && $statement->rowCount() > 0) { ?>
    <h2>Historique des commandes</h2><br>

    <table>
      <thead>
<tr>
  <th>NOM</th>
  <th>PRENOM</th>
  <th>PRODUIT</th>
  <th>Adresse de livraison</th>
  <th>Date de commande</th>
</tr>
      </thead>
      <tbody>
  <?php foreach ($result as $row) { ?>
      <tr>
<td><?php echo escape($row["nom"]); ?></td>
<td><?php echo escape($row["prenom"]); ?></td>
<td><?php echo escape($row["libelle"]); ?></td>
<td><?php echo escape($row["adresse_livraison"]); ?></td>
<td><?php echo escape($row["dates"]); ?></td>
      </tr>
    <?php } ?>
      </tbody>
  </table>
  <?php } else { ?>
    > No results found for <?php echo escape($_POST['nom']); ?>.
  <?php }
} ?>



<a href="index.php">Retour</a>

<?php require "templates/footer.php"; ?>