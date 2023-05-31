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
  <label for="client">Nom du client</label><br>
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
<br>
  <label for="produit">Produit</label><br>
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
  <label class="block" for="adresse_livraison">
    <span class="after:content-['*'] after:ml-0.5 after:text-red-500 block text-sm font-medium text-slate-700">
    Adresse de livraison
    </span>
    <input type="text" name="adresse_livraison" class="mt-1 px-3 py-2 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-sky-500 block 
    rounded-md sm:text-sm focus:ring-1" placeholder="Entrez votre adresse" />
    </label>
  <input type="submit" name="submit" class="mt-1 px-3 py-2 bg-blue-300 border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-sky-500 block rounded-md sm:text-sm focus:ring-1" value="Envoyer" />
</form>
<br>
<a href="index.php">Retour</a>

<?php require "templates/footer.php"; ?>