<?php
session_start();
//destuction de la session
session_destroy();
//on redirige vers la page de connexion
header("Location: ../index.php");
