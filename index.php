<?php include("array_php.php")?>

<!-- PAGE PRINCIPALE de présentation des bières -->
<!DOCTYPE html>
<html>

<head>
  <meta charset='UTF-8' />
  <title>Les bières</title>
<!--   <link rel='stylesheet' href='style.css' />
 -->
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta charset="utf-8">
  <link rel="stylesheet" href="monstyle.css">
</head>

<body>
<div class='container'>
  <!-- Entete  -->
  <header>
    <h1>Les bières</h1>
     
 </header>
    <!-- Bouton de lancement du fichier boncommande.php -->
    <a href="form.php">
        <button class="lien" type="submit">je veux</button>
    </a>
    <section>
      <!-- BOUCLE de lecture du tableau pour afficher un article par bière -->
<?php for ($i=0; $i < count($beerArray) ; $i++):?>
      <article>
        <h3><?= (String)$beerArray[$i][0]?></h3>
        <img src="<?= $beerArray[$i][1] ?>"/>
        <p><?= substr((String)$beerArray[$i][2],0,150) . '...';  ?></p>
        <div>
          <h3 id='<?= $i; ?>'><?=(String)number_format($beerArray[$i][3]*1.2,2,',',' ') . '€';?></h3>
          <button onclick= retirebiere(this,<?=$beerArray[$i][3]*1.2?>)>-</button>
          <button onclick= ajoutbiere(this,<?=$beerArray[$i][3]*1.2?>)>+</button>
        </div>
     </article>
<?php  endfor; ?>
  </section>

</div>

<!-- JAVASCRIPT : fonctions de réponse aux boutons onclick -->
  <script src="assets/js/functions.js"></script>
</body>


</html>
