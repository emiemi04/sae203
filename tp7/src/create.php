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

<h2 class="ml-8 text-3xl">Ajout d'un client</h2><br>

<form method="post" class="grid grid-rows-6 gap-8 place-content-center">

<?php if (isset($_POST['submit']) && $statement) {
    echo "<blockquote>" . escape ($_POST['nom']) . " " . escape ($_POST['prenom']) . " ajouté avec succès</blockquote>";
}
?>
    <input type="text" name="nom" placeholder="Nom" class="border border-cyan-900 px-3 py-2 
    rounded-lg focus:outline-none focus:border-amber-600 focus:ring-1 focus:ring-amber-600"/>
    
    <input type="text" name="prenom" placeholder="Prénom" class="border border-cyan-900 px-3 py-2 
    rounded-lg focus:outline-none focus:border-amber-600 focus:ring-1 focus:ring-amber-600"/>

    <input type="text" name="adresse" placeholder="Adresse" class="border border-cyan-900 px-3 py-2 
    rounded-lg focus:outline-none focus:border-amber-600 focus:ring-1 focus:ring-amber-600"/>

    <input type="text" name="code_postal" placeholder="Code Postal" class="border border-cyan-900 px-3 py-2 
    rounded-lg focus:outline-none focus:border-amber-600 focus:ring-1 focus:ring-amber-600"/>
    
    <input type="text" name="ville" placeholder="Ville" class="border border-cyan-900 px-3 py-2 
    rounded-lg focus:outline-none focus:border-amber-600 focus:ring-1 focus:ring-amber-600"/>

    <input type="submit" name="submit" class="px-3 py-2  bg-amber-100 border border-cyan-900 text-cyan-950
    rounded-lg focus:outline-none focus:border-amber-600 focus:ring-1 focus:ring-amber-600" 
    value="Envoyer" />

</form>



<a href="index.php" class="m-8 rounded-lg bg-cyan-900 
border border-cyan-950 px-3 py-1 text-amber-200">Retour</a>

<?php require "templates/footer.php"; ?>