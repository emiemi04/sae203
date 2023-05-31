<?php
/* Utiliser un formulaire pour ajouter des produits dans la table 'produit'*/

if (isset($_POST['submit'])) {
    if (!hash_equals($_SESSION['csrf'], $_POST['csrf'])) die();
    
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
}

require "templates/header.php";

if (isset($_POST['submit']) && $statement) :
    echo "<blockquote" . escape ($_POST['code_produit']) . "ajouté avec succès</blockquote>";
endif; ?>

<h2>Ajout d'un produit</h2>

<form method="post">
    <label class="block" for="code_produit">
    <span class="after:content-['*'] after:ml-0.5 after:text-red-500 
    block text-sm font-medium text-slate-700">
    Code produit
    </span>
    <input type="text" name="nom" class="mt-1 px-3 py-2 bg-white border shadow-sm 
    border-slate-300 placeholder-slate-400 focus:outline-none focus:border-sky-500 
    focus:ring-sky-500 block rounded-md sm:text-sm focus:ring-1" 
    placeholder="Code pour le produit" />
    </label>
    
    <label class="block" for="libelle">
    <span class="after:content-['*'] after:ml-0.5 after:text-red-500 block 
    text-sm font-medium text-slate-700">
    libelle
    </span>
    <input type="text" name="libelle" class="mt-1 px-3 py-2 bg-white border shadow-sm border-slate-300 
    placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-sky-500 
    block rounded-md sm:text-sm focus:ring-1" placeholder="Libelle du produit" />
    </label>
    
    <label class="block" for="prix_unitaire">
    <span class="after:content-['*'] after:ml-0.5 after:text-red-500 block text-sm font-medium text-slate-700">
    Prix unitaire
    </span>
    <input type="text" name="prix_unitaire" class="mt-1 px-3 py-2 bg-white border shadow-sm border-slate-300 
    placeholder-slate-400 focus:outline-none focus:border-sky-500 
    focus:ring-sky-500 block rounded-md sm:text-sm focus:ring-1" 
    placeholder="Prix unitaire en euros" />
    </label>
    
    <input type="submit" name="submit" class="mt-1 px-3 py-2 bg-blue-300 border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-sky-500 block rounded-md sm:text-sm focus:ring-1" value="Envoyer" />

</form>
<br>
<a href="index.php">Retour</a>

<?php require "templates/footer.php"; ?>