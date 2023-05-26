<?php

/* Utilisation d'un formulaire HTML pour créer des clients dans la table 'clients'. */

if (isset($_POST['submit'])) {
    require "../config.php";
    require "../common.php";

    try  {
        $connection = new PDO($dsn, $username, $password, $options);
        
        $new_user = array(
            "nom" => $_POST['nom'],
            "prenom"  => $_POST['prenom'],
            "adresse"     => $_POST['adresse'],
            "code_postal"       => $_POST['code_postal'],
            "ville"  => $_POST['ville']
        );

        $sql = sprintf(
                "INSERT INTO %s (%s) values (%s)",
                "client",
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
    <blockquote><?php echo $_POST['prenom']; ?> ajouté(e) avec succès.</blockquote>
<?php } ?>

<h2>Ajout d'un client</h2>

<form method="post">
    <label for="nom">Nom</label>
    <input type="text" name="nom" id="nom">
    <label for="prenom">Prénom</label>
    <input type="text" name="prenom" id="prenom">
    <label for="adresse">Adresse</label>
    <input type="text" name="adresse" id="adresse">
    <label for="code_postal">Code postal</label>
    <input type="text" name="code_postal" id="code_postal">
    <label for="ville">Ville</label>
    <input type="text" name="ville" id="ville">
    <input type="submit" name="submit" value="Submit">
</form>

<a href="index.php">Retour</a>

<?php require "templates/footer.php"; ?>