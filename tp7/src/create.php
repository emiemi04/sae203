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
    <label class="block" for="nom">
    <span class="after:content-['*'] after:ml-0.5 after:text-red-500 block text-sm font-medium text-slate-700">
    Nom
    </span>
    <input type="text" name="nom" class="mt-1 px-3 py-2 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-sky-500 block rounded-md sm:text-sm focus:ring-1" placeholder="Votre nom" />
    </label>
    
    <label class="block" for="prenom">
    <span class="after:content-['*'] after:ml-0.5 after:text-red-500 block text-sm font-medium text-slate-700">
    Prénom
    </span>
    <input type="text" name="prenom" class="mt-1 px-3 py-2 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-sky-500 block rounded-md sm:text-sm focus:ring-1" placeholder="Votre prénom" />
    </label>
    
    <label class="block" for="adresse">
    <span class="after:content-['*'] after:ml-0.5 after:text-red-500 block text-sm font-medium text-slate-700">
    Adresse
    </span>
    <input type="text" name="adresse" class="mt-1 px-3 py-2 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-sky-500 block rounded-md sm:text-sm focus:ring-1" placeholder="Votre adresse" />
    </label>
    
    <label class="block" for="code_postal">
    <span class="after:ml-0.5 after:text-red-500 block text-sm font-medium text-slate-700">
    Code postal
    </span>
    <input type="text" name="code_postal" class="mt-1 px-3 py-2 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-sky-500 block rounded-md sm:text-sm focus:ring-1" placeholder="Code postal de votre ville" />
    </label>
    
    <label class="block" for="ville">
    <span class="after:ml-0.5 after:text-red-500 block text-sm font-medium text-slate-700">
    Ville
    </span>
    <input type="text" name="ville" class="mt-1 px-3 py-2 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-sky-500 block rounded-md sm:text-sm focus:ring-1" placeholder="Votre ville" />
    </label>
    <input type="submit" name="submit" class="mt-1 px-3 py-2 bg-blue-300 border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-sky-500 block rounded-md sm:text-sm focus:ring-1" value="Envoyer" />

</form>
<br>
<a href="index.php">Retour</a>

<?php require "templates/footer.php"; ?>