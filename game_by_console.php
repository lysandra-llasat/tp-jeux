<?php require_once './template/_header.php' ?>
<?php require_once './template/_game.php' ?>
<?php require_once './requete/get_game.php' ?>
<?php require_once './requete/config.php' ?>
<?php require_once './requete/transform_number.php' ?>
<?php require_once './template/_navbar.php' ?>

<?php
if (isset($_GET['console_id'])) {
    $console_id = intval($_GET['console_id']);
    echo "<div class= 'd-flex flex-wrap justify-content-center'>";
    get_all_game_by_console($console_id);
    echo "</div>";
} else {
    echo "<div class= 'd-flex flex-wrap justify-content-center'>";
    get_all_games(0);
    echo "</div>";
}
?>

<?php require_once './template/_footer.php' ?>