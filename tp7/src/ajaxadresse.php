<?php
 require "../config.php";
 require "../common.php";

 try {
 $connection = new PDO($dsn, $username, $password, $options);

 // Requête pour récupérer tous les 'id_produit' et leur 'libelle'
 $sql_1 = "SELECT P.`id_produit`, P.`libelle` FROM produit AS C, `produit` AS P
 WHERE C.`id_client` = ". $_POST['id_client'] . " AND P.`id_produit` = C.`id_produit` ";

 $statement_1 = $connection->prepare($sql_1);
 $statement_1->execute();
 $result_1 = $statement_1->fetchAll();

 } catch(PDOException $error) {
 echo $sql_1 . "<br>" . $error->getMessage();
 }

 echo "<select name='id_produit'>";
 if ($result_1 && $statement_1->rowCount() > 0)
 foreach ($result_1 as $row_1) :
 echo "<option value='". escape($row_1['id_produit']). "'>".
 escape($row_1['libelle']) ."</option>";
 endforeach;
 echo "</select>";

 ?>