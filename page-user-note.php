<?php require_once './template/_header.php' ?>
<?php require_once './template/_game.php' ?>
<?php require_once './requete/get_game.php' ?>
<?php require_once './requete/config.php' ?>
<?php require_once './requete/transform_number.php' ?>

<?php require_once './template/_navbar.php' ?>

<div class="d-flex flex-wrap justify-content-center"><?php
                                                        get_all_note_user_desc()
                                                        ?></div>

<?php require_once './template/_footer.php' ?>