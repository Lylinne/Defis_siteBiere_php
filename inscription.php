<?php
require ('donne.php');
if(!empty($_POST)){
	$nom				= ($_POST['nom']);
	$prenom 			= ($_POST['prenom']);
	$adresse 			= ($_POST['adresse']);
	$codePostal 		= ($_POST['codePostal']);
	$ville 				= ($_POST['ville']);
	$pays 				= ($_POST['pays']);
	$telephone 			= ($_POST['telephone']);
	$email 				= ($_POST['email']);
	$motdepasse 		= ($_POST['motdepasse']);
	$verification_MDP 	= ($_POST['verification_MDP']);

	if (!empty($email) && !empty($motdepasse)) {
		require_once 'donne.php';
		$sql0 = 'SELECT * FROM utilisateur WHERE email = ?';
		$statement1 = $pdo->prepare($sql0);
		$statement1-> execute([$email]);
		$result = $statement1->fetch();

		if (!$result) {
			if (strlen($motdepasse) <= 10 && strlen($motdepasse) >= 5) {
				if ($motdepasse === $verification_MDP) {

					$motdepasse = password_hash($motdepasse, PASSWORD_BCRYPT);
					require_once 'donne.php';
					$sql = 'INSERT INTO utilisateur (`nom`, `prenom`, `adresse`, `codePostal`, `ville`, `pays`, `telephone`, `email`, `motdepasse`)  VALUES (:nom, :prenom, :adresse, :codePostal, :ville, :pays, :telephone, :email, :motdepasse)';

					$statement = $pdo->prepare($sql);
					$resultat = $statement->execute([
					':nom'			=>$nom, 
					':prenom'		=>$prenom,
					':adresse'		=>$adresse, 
					':codePostal'	=>$codePostal, 
					':ville'		=>$ville, 
					':pays' 		=>$pays, 
					':telephone'	=>$telephone, 
					':email'		=>$email, 
					':motdepasse'	=>$motdepasse]);

					if ($resultat) {

						$_SESSION["connect"] = true;
						$_SESSION["username"] = $username;
						header("location: page.php");
						
					}else{
						die("erreur d'inscription");
					}
				}else{
					die("mot de passe différent");
				}
				
			}else{
				die("mot de passe non conforme");
			}
			
		}else{
			die("utilisateur existe déjà");
		}	

	}else{

	}

}



 