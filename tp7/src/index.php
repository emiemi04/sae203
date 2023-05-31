<?php include "templates/header.php"; ?>

<ul class="grid grid-cols-4 gap-4">
	<li class="lg:[&:nth-child(3)]:hover:underline">
	<a href="create.php" class="group block max-w-xs mx-auto rounded-lg p-6 bg-white ring-1 ring-slate-900/5 shadow-lg space-y-3 hover:bg-cyan-900 hover:ring-cyan-900">
		<div class="flex items-center space-x-3">
			<h2 class="text-slate-900 group-hover:text-white text-sm font-semibold">Ajouter un client</h2>
		</div>
  <p class="text-slate-500 group-hover:text-white text-sm">En utilisant ce lien vous pourrez ajouter un client dans la BDD.</p>
</a>
	</li>

<li class="lg:[&:nth-child(3)]:hover:underline">
	<a href="produit.php" class="group block max-w-xs mx-auto rounded-lg p-6 bg-white ring-1 ring-slate-900/5 shadow-lg space-y-3 hover:bg-cyan-900 hover:ring-cyan-900">
		<div class="flex items-center space-x-3">
			<h2 class="text-slate-900 group-hover:text-white text-sm font-semibold">Ajouter un produit</h2>
		</div>
  <p class="text-slate-500 group-hover:text-white text-sm">En utilisant ce lien vous pourrez ajouter un produit dans la BDD.</p>
</a>

<li class="lg:[&:nth-child(3)]:hover:underline">
	<a href="read.php" class="group block max-w-xs mx-auto rounded-lg p-6 bg-white ring-1 ring-slate-900/5 shadow-lg space-y-3 hover:bg-cyan-900 hover:ring-cyan-900">
		<div class="flex items-center space-x-3">
			<h2 class="text-slate-900 group-hover:text-white text-sm font-semibold">Commander un produit</h2>
		</div>
  <p class="text-slate-500 group-hover:text-white text-sm">En utilisant ce lien vous pourrez commander un produit.</p>
</a>
	</li>

	<li class="lg:[&:nth-child(3)]:hover:underline">
	<a href="adresse_livraison.php" class="group block max-w-xs mx-auto rounded-lg p-6 bg-white ring-1 ring-slate-900/5 shadow-lg space-y-3 hover:bg-cyan-900 hover:ring-cyan-900">
		<div class="flex items-center space-x-3">
			<h2 class="text-slate-900 group-hover:text-white text-sm font-semibold">Historique commande</h2>
		</div>
  <p class="text-slate-500 group-hover:text-white text-sm">En utilisant ce lien vous pourrez consulter les commandes effectuées.</p>
</a>
	</li>

</ul>



<?php include "templates/footer.php"; ?>