<!doctype html>
<html lang="fr">

<head>
	<meta charset="utf-8">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>CALPETARD Mahé CHÉLONÉ Émilie</title>
	<script src="https://cdn.tailwindcss.com"></script>
	
	<script type='text/javascript'>
 function getXhr(){
  var xhr = null;
  if(window.XMLHttpRequest) // Firefox et autres
  xhr = new XMLHttpRequest();
  else if(window.ActiveXObject){ // Internet Explorer
  try {
 xhr = new ActiveXObject("Msxml2.XMLHTTP");
 } catch (e) {
 xhr = new ActiveXObject("Microsoft.XMLHTTP");
 }
 }
 else { // XMLHttpRequest non supporté par le navigateur
 alert("Votre navigateur ne supporte pas les objets XMLHTTPRequest...");
 xhr = false;
 }
 return xhr;
 }

 /**  Méthode qui sera appelée sur le click du bouton */
 function go(){
 var xhr = getXhr();
 // On défini ce qu'on va faire quand on aura la réponse
 xhr.onreadystatechange = function(){
 // On ne fait quelque chose que si on a tout reçu et que le serveur est ok
 if(xhr.readyState == 4 && xhr.status == 200){
 leselect = xhr.responseText;
 // On se sert de innerHTML pour rajouter les options a la liste
 document.getElementById('id_produit').innerHTML = leselect;
 }
 }

 // Ici on va voir comment faire du post
 xhr.open("POST","ajaxadresse.php",true);
 // ne pas oublier ça pour le post
 xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
 // ne pas oublier de poster les arguments
 // ici, l'id du client
 sel = document.getElementById('id_client');
 id_client = sel.options[sel.selectedIndex].value;
 xhr.send("id_client="+id_client);
 }
 </script>


</head>

<body class="p-8 bg-gray-300">
	<H1 class="text-4xl font-bold">Système simple de gestion d'un magasin</H1>
	<br>