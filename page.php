<?php
require ('connect.php');

echo "bonjour {$username}<br />";
echo "super site  <br />";
?>

<a href="page.php">Site</a><br/>
<a href="profil.php">Mon Profil</a><br/>
<a href="index.php">Les Bières</a><br/>
<a href="?deconnect=true">déconnexion</a>