<?php
 		require ('connect.php');
 		require ('configuration.php');?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="assets/css/tonstyle.css">
	<title>formulaire</title>
</head>
<body>
	<header>
		<h1>INSCRIPTION ET CONNEXION</h1>
	</header>
	<div class="donnee">
		<form class="inscription" action="inscription.php" method="POST">
			<label>Nom</label>
			<input  type="text" name="nom" placeholder="nom" required="required" />
			<label>Prénom</label>
			<input type="text" name="prenom" placeholder="prenom" required="required">
			<label>Adresse</label>
			<input type="text" name="adresse" placeholder="adresse" required="required">
			<label>CPostal</label>
			<input type="nombre" name="codePostal" placeholder="codePostal" required="required">
			<label>Ville</label>
			<input type="text" name="ville" placeholder="ville" required="required">
			<label>Pays</label>
			<input type="text" name="pays" placeholder="pays" required="required">
			<label>Phone</label>
			<input type="tel" name="telephone" placeholder="telephone" required="required">
			<label>Mail</label>
			<input type="email" name="email" placeholder="email" required="required">
			<label>confirmation mail</label>
			<input type="email" name="veri_email" placeholder="veri_email" required="required">
			<label>Password</label>
			<input class="motPasse" type="password" name="motdepasse" placeholder="Motdepasse" required="required" />
			<label>Confirmer<br>password</label>
			<input class="motPasse" type="password" name="verification_MDP" placeholder="verification_MDP" required="required"/>
			<input type="robot" name="robot" placeholder="robot"/>

				<button type="submit" value="Inscription"> Inscription</button>
		
		</form>
		<form class="connexion" action="connect.php" method="POST">
		       <label>Adresse mail</label>
		       <input type="email" name="email" placeholder="adresse mail" required="required">
		       <label>Mot de passe</label>
		       <input type="password" name="motdepasse" placeholder="MDP" required="required">
		       	
		          <button type="submit" value="connexion">Connexion</button>
		      	
		</form>
	</div>
</body>
</html>