<?php
include('conf.php');

$DataBase = mysqli_connect(DBHOST, DBUSER, DBPASSWORD, DBNAME);

if(mysqli_connect_error()){
    print('Connexion à la base de donnée: KO'.mysqli_connect_error());
    exit();
}