<?php require_once './template/_header.php' ?>
<?php require_once './template/_form.php' ?>
<img class="logo" src="/images/logo.png" alt="logo">

<?php
form(
    "Se connecté",
    "./requete/authentification.php",
    "se connecter",
    "vous n'avez pas de compte ?",
    "./inscription.php",
    "inscrivez-vous"
)
?>

<?php require_once './template/_footer.php' ?>