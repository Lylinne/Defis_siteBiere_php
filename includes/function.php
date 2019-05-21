<?php

/**
* crée une connexion à la base de données
*	@return \PDO
*/
function getBD( $dbuser 	= 'Lyline',
				$dbpassword = '',
				$dbhost 	= 'localhost',
				$dbname 		='lyline')
{
	$dsn = 'mysql:dbname='.$dbname.
';host='.$dbhost.';charqet=UTF8';
	try{
		$pdo = new PDO($dns, $dbuser, $dbpassword);

		//definit mode de recupération en mode tableau associatif
    	// $user["lastname"];
		$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

		//definit mode de recupération en mode Objet
    	//$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
    	// $user->lastname;
		return $pdo;
	}
	catch (PDOException $e) {
		echo 'Connexion échouée :'.$e->getMessage();
		die();
	}
}

/**
*	génère un champ de formulaire de type input
*	@return String
*/
function input($name, $label,$value="", $type='text', $require=true)//:string
{
	$input = "<div class=\"form-group\"><label for=\"".
	$name."\">".$label.
	"</label><input id=\"".
	$name."\" type=\"".$type.
	"\" name=\"".$name."\" value=\"".$value."\" ";
	$input .= ($require)? "required": "";
	$input .= "></div>";

	return $input;
}

/**
* Connect le client
* @return boolean|void
*/
function userConnect($mail, $password, $verify=false){//:boolean|void
	require 'config.php';

	$sql = "SELECT * FROM users WHERE `mail`= ?";
	$pdo = getDB($dbuser, $dbpassword, $dbhost,$dbname);

		$statement = $pdo->prepare($sql);
		$statement->execute([htmlspecialchars($mail)]);
		$user = $statement->fetch();
		if(	$user && 
			password_verify(
			htmlspecialchars($password), $user['password']
		)){
				if($verify){
					return true;
					//exit();
				}

				if (session_status() != PHP_SESSION_ACTIVE){
					session_start();
				}
				unset($user['password']);
				$_SESSION['auth'] = $user;
				//connecté
				header('location: profil.php');
				exit();

		}else{

			if($verify){
				return false;
				//exit();
			}
			if (session_status() != PHP_SESSION_ACTIVE){
					session_start();
				}
			$_SESSION['auth'] = false;
			header('location: login.php');
			//TODO : err pas connecté
		}

}

/**
* verifie que l'utilisateur est connecté
* @return array|void
*/
function userOnly($verify=false){//:array|void|boolean
	if (session_status() != PHP_SESSION_ACTIVE){
		session_start();
	}
	// est pas defini et false
	if(!$_SESSION["auth"]){
		if($verify){
			return false;
		//exit();
		}
		header('location: login.php');
		exit();
	}
	return $_SESSION["auth"];
}