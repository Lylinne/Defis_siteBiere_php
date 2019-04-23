<?php
include("array_php.php");
require ('db.php');
require ('config.php');

$sql = 'INSERT INTO bière (titre, img, description, prix) VALUES (:titre, :img, :description, :prix)';

  foreach ($beerArray as $element) {
    $stmt = $pdo->prepare($sql);
    $result = $stmt->execute([
        ':titre'       =>$element[0],
        ':img'         => $element[1],
        ':description' =>$element[2],
        ':prix'        =>$element[3]
      ]);
  }
