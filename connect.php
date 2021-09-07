<?php
    include_once('conf.php');
    $db = mysqli_connect(SERVEUR,USER,MDP,DB);
    $resultat = mysqli_query($db,'SELECT * FROM type_livre ');
?>