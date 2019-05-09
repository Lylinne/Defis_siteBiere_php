<?php
include("array_php.php");
require ('configuration.php');

$sql = 'INSERT INTO bière (titre, img, description, prix) VALUES (:titre, :img, :description, :prix)';

  foreach ($beerArray as $element) {
  	$pdo = new PDO($dbuser, $dbhost, $dbpassword, $dbname);
    $stmt = $pdo->prepare($sql);
    $result = $stmt->execute([
        ':titre'       =>$element[0],
        ':img'         =>$element[1],
        ':description' =>$element[2],
        ':prix'        =>$element[3]
      ]);
  }
