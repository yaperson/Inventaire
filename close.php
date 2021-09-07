<?php
 //--- Libérer l'espace mémoire du résultat de la requête
 mysqli_free_result($Resultat);

 //--- Déconnection de la base de données
 mysqli_close($DataBase);
?>