<?php
require ('donne.php');

if(!empty($_POST)){
	var_dump($_POST);
	if(	isset($_POST["nom"]) 				&& !empty($_POST["nom"]) && 
		isset($_POST["prenom"]) 			&& !empty($_POST["prenom"]) &&
		isset($_POST["adresse"]) 			&& !empty($_POST["adresse"]) &&
		isset($_POST["codePostal"]) 		&& !empty($_POST["codePostal"]) &&
		isset($_POST["ville"]) 				&& !empty($_POST["ville"]) &&
		isset($_POST["pays"]) 				&& !empty($_POST["pays"]) &&
		isset($_POST["telephone"]) 			&& !empty($_POST["telephone"]) &&
		isset($_POST["email"]) 				&& !empty($_POST["email"]) &&
		isset($_POST["verif_mail"])			&& !empty($_POST["verif_mail"]) &&
		isset($_POST["motdepasse"]) 		&& !empty($_POST["motdepasse"]) &&
		isset($_POST["verification_MDP"]) 	&& !empty($_POST["verification_MDP"]) &&
		isset($_POST["robot"]) 				&& empty($_POST["robot"]) 
	
	){
		
		if (
			 (filter_var($_POST["email"], FILTER_VALIDATE_EMAIL) && 
			  $_POST["email"] == $_POST["verif_mail"]
			) 
			&& 
			($_POST["motdepasse"] == $_POST["verification_MDP"])
		){
			$sql = 'SELECT *FROM utilisateur WHERE email = ?';
			$pdo = getBD($dbuser, $dbhost, $dbpassword, $dbname);
			$statement = $pdo->prepare($sql);
			$statement->ewecute(
								[ 
									htmlspecialchars(["email"])
								]
			);
			$user = $statement ->fetch();

			if ($user) {
			 	$motdepasse = password_hash(htmlspecialchars($_POST["motdepasse"]), PASSWORD_BCRYPT);
				$sql = "INSERT INTO `utilisateur` (nom, prenom, adresse, codePostal, ville, pays, telephone, email, motdepasse) VALUES (
				 :nom,				 
				 :prenom,
				 :adresse,
				 :codePostal, 
				 :ville,
				 :pays,
				 :telephone,
				 :email,
				 :motdepasse)
				 ";
				$statement = $pdo->prepare($sql);
				$result = $statement->execute([
					":nom"			=> htmlspecialchars($_POST["nom"]),
					":prenom"		=> htmlspecialchars($_POST["prenom"]),
					":adresse"		=> htmlspecialchars($_POST["adresse"]),
					":codePostal"	=> htmlspecialchars($_POST["codePostal"]),
					":ville"		=> htmlspecialchars($_POST["ville"]),
					":pays"			=> htmlspecialchars($_POST["pays"]),
					":telephone"	=> htmlspecialchars($_POST["telephone"]),
					":mail"			=> htmlspecialchars($_POST["email"]),
					":motdepasse"	=> $motdepasse
				]);

				if ($result) {
					userConnect($_POST["mail"], $_POST["password"]);
				}else{
					die("pas ok");
			 	}
			}else{//fin verif user existe
				userConnect($_POST["mail"], $_POST["password"]);
			}	
		}//fin verification mail et password

	}else{//fin champ tous définis
			die('bac a sable');//securisation
		}
}//fin if post		


 