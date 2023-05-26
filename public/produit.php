<?php
/* Utiliser un formulaire pour ajouter des produits dans la table 'produit'*/

if (isset($_POST['submit'])) {
    require "../config.php";
    require "../common.php";

    try  {
        $connection = new PDO($dsn, $username, $password, $options);
        
        $new_user = array(
            "code_produit" => $_POST['code_produit'],
            "libelle"  => $_POST['libelle'],
            "prix_unitaire"     => $_POST['prix_unitaire'],
        );

        $sql = sprintf(
                "INSERT INTO %s (%s) values (%s)",
                "produit",
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
    <blockquote><?php echo $_POST['libelle']; ?> ajouté(e) avec succès.</blockquote>
<?php } ?>

<h2>Ajout d'un produit</h2>

<form method="post">
    <label for="code_produit">Code produit</label>
    <input type="text" name="code_produit" id="code_produit">
    <label for="libelle">Libelle</label>
    <input type="text" name="libelle" id="libelle">
    <label for="prix_unitaire">Prix unitaire (en euros)</label>
    <input type="text" name="prix_unitaire" id="prix_unitaire">
    <input type="submit" name="submit" value="Submit">
</form>

<a href="index.php">Retour</a>

<?php require "templates/footer.php"; ?>