<?php
//on déclare nos constantes 
define('DB_HOST', 'database');
define('DB_USER', 'admin');
define('DB_PASS', 'admin');
define('DB_NAME', 'jeux');

//on crée la conexion a la base de données 
$connection = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

//si on a une erreur de connexion on affiche l'erreur 
if(!$connection){
    die("erreur:" .mysqli_connect_error());
}

//echo 'Connexion réussie'; 
//on test la conexion en premier si elle marche on le commante

//forcer l'encodage en utf8
mysqli_set_charset($connection, "utf8");
