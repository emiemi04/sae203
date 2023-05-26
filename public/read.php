<?php

/**
 * Function to query information based on 
 * a parameter: in this case, adresse.
 *
 */

if (isset($_POST['submit'])) {
    try  {
        
        require "../config.php";
        require "../common.php";

        $connection = new PDO($dsn, $username, $password, $options);

        $sql = "SELECT * 
                        FROM clients
                        WHERE adresse = :adresse";

        $nom = $_POST['adresse'];

        $statement = $connection->prepare($sql);
        $statement->bindParam(':adresse', $nom, PDO::PARAM_STR);
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
        <h2>Résultats</h2>

        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Adresse</th>
                    <th>Code postal</th>
                    <th>Ville</th>
                </tr>
            </thead>
            <tbody>
        <?php foreach ($result as $row) { ?>
            <tr>
                <td><?php echo escape($row["id"]); ?></td>
                <td><?php echo escape($row["nom"]); ?></td>
                <td><?php echo escape($row["prenom"]); ?></td>
                <td><?php echo escape($row["adresse"]); ?></td>
                <td><?php echo escape($row["code_postal"]); ?></td>
                <td><?php echo escape($row["ville"]); ?></td>
            </tr>
            
        <?php } ?>
        </tbody>
    </table>
    <?php } else { ?>
        <blockquote>Pas de résultat trouvé pour <?php echo escape($_POST['adresse']); ?>.</blockquote>
    <?php } 
} ?> 



<h2>Commander un produit</h2>

<form method="post">
    <label for="adresse">Adresse de livraison</label>
    <input type="text" id="adresse" name="adresse">
    <label for="nom">Nom du client</label>
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

// Exécuter une requête SQL pour récupérer les éléments de la table clients
$sql = "SELECT id, nom FROM clients";
$result = $conn->query($sql);

// Créer la balise <select> et ses options
if ($result->num_rows > 0) {
    echo '<select name="nom_select">';
    while ($row = $result->fetch_assoc()) {
        echo '<option value="' . $row['id'] . '">' . $row['nom'] . '</option>';
    }
    echo '</select>';
} else {
    echo "Aucun résultat trouvé.";
}
?>

<label for="produit">Produit</label>
<?php
// Exécuter une requête SQL pour récupérer les éléments de la table produit
$sql = "SELECT id_produit, libelle FROM produit";
$result = $conn->query($sql);

// Créer la balise <select> et ses options
if ($result->num_rows > 0) {
    echo '<select name="produit_select">';
    while ($row = $result->fetch_assoc()) {
        echo '<option value="' . $row['id_produit'] . '">' . $row['libelle'] . '</option>';
    }
    echo '</select>';
} else {
    echo "Aucun résultat trouvé.";
}

// Fermer la connexion à la base de données
$conn->close();
?>
<br><br>
    <input type="submit" name="submit" value="Submit">
</form>

<a href="index.php">Retour</a>

<?php require "templates/footer.php"; ?>