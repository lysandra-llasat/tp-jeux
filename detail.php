<?php require_once './template/_header.php' ?>
<?php require_once './template/_game.php' ?>
<?php require_once './requete/get_game.php' ?>
<?php require_once './requete/config.php' ?>
<?php require_once './requete/transform_number.php' ?>

<img class="logo" src="/images/logo.png" alt="logo">
<?php require_once './template/_navbar.php' ?>

<?php
$game_id = intval($_GET['game_id']);
get_game_detail($game_id);

?>

<?php require_once './template/_footer.php' ?>