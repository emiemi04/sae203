<?php
/* Utiliser un formulaire pour ajouter des produits dans la table 'produit'*/

if (isset($_POST['submit'])) {
    
    require "../config.php";
    require "../common.php";

    try  {
        $connection = new PDO($dsn, $username, $password, $options);
        
        $new_prod = array(
            "code_produit" => $_POST['code_produit'],
            "libelle"  => $_POST['libelle'],
            "prix_unitaire"     => $_POST['prix_unitaire'],
        );

        $sql = sprintf(
                "INSERT INTO %s (%s) values (%s)",
                "produit",
                implode(", ", array_keys($new_prod)),
                ":" . implode(", :", array_keys($new_prod))
        );
        
        $statement = $connection->prepare($sql);
        $statement->execute($new_prod);
    } catch(PDOException $error) {
        echo $sql . "<br>" . $error->getMesscode_postal();
    }
} ?>

<?php require "templates/header.php"; ?>

<h2 class="ml-8 text-3xl">Ajout d'un produit</h2><br>

<form method="post" class="grid grid-rows-3 gap-8 place-content-center">

<?php if (isset($_POST['submit']) && $statement) {
    echo "<br><blockquote> Produit : " . escape ($_POST['libelle']) . " ajouté avec succès</blockquote><br>";
}
?>
    
    <input type="text" name="code_produit" placeholder="Code du produit" class="border border-cyan-900 px-3 py-2 
    rounded-lg focus:outline-none focus:border-amber-600 focus:ring-1 focus:ring-amber-600"/>
    
    <input type="text" name="libelle" placeholder="Nom du produit" class="border border-cyan-900 px-3 py-2 
    rounded-lg focus:outline-none focus:border-amber-600 focus:ring-1 focus:ring-amber-600"/>

    <input type="text" name="prix_unitaire" placeholder="Prix du produit" class="border border-cyan-900 px-3 py-2 
    rounded-lg focus:outline-none focus:border-amber-600 focus:ring-1 focus:ring-amber-600"/>
    
    <input type="submit" name="submit" class="px-3 py-2  bg-amber-100 border border-cyan-900 text-cyan-950
    rounded-lg focus:outline-none focus:border-amber-600 focus:ring-1 focus:ring-amber-600" 
    value="Envoyer" />

</form>
<br>



<a href="index.php" class="m-8 rounded-lg bg-cyan-900 
border border-cyan-950 px-3 py-1 text-amber-200">Retour</a>

<?php require "templates/footer.php"; ?>