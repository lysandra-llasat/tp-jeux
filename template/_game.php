<?php

function render_game($game)
{
?>
    <div class="card" style="width: 16rem;">
        <img src="../images/games/<?php echo $game['image_jeux'] ?>" class=" picture card-img-top" alt="<?php echo $game['titre'] ?>">
        <div class="card-body">
            <h5 class="card-title"><?php echo $game['titre'] ?></h5>
            <p class="card-text"><?php echo get_price($game) ?></p>

            <a href="../detail.php?game_id=<?php echo $game['id'] ?>" class="btn btn-primary">Voir détail</a>
        </div>
    </div>

<?php
}

function render_game_user($game)
{
?>
    <div class="card" style="width: 16rem;">
        <img src="../images/games/<?php echo $game['image_jeux'] ?>" class=" picture card-img-top" alt="<?php echo $game['titre'] ?>">
        <div class="card-body">
            <span>Avis utilisateur: <?php echo $game['note_utilisateur']  . "/20" ?> <br> Avis presse: <?php echo $game['note_media']  . "/20" ?></span>
            <h5 class="card-title"><?php echo $game['titre'] ?></h5>
            <p class="card-text"><?php echo get_price($game) ?></p>

            <a href="../detail.php?game_id=<?php echo $game['id'] ?>" class="btn btn-primary">Voir détail</a>
        </div>
    </div>

<?php
}

function render_detail($game)
{
?>
    <div class="card-detail mb-3 border border-solid border-gray-300 p-3 rounded border-radius-5">
        <div class="row g-0">
            <div class="col-md-4">
                <img src="../images/games/<?php echo $game['image_path'] ?>" class="img-fluid rounded-start" alt="<?php echo $game['titre'] ?>">
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <h5 class="card-title"><?php echo $game['titre'] ?></h5>
                    <div><?php get_console($game['id']) ?></div>
                    <p class="card-text"><?php echo $game['description'] ?></p>
                    <p class="card-text"><small class="text-muted">Date de sortie: <?php echo date_format(new DateTime($game['date_sortie']), 'd/m/Y') ?> </small></p>
                    <div class="img">
                        <img src="../images/pegi/<?php echo $game['image_age'] ?>" class="pegi img-fluid rounded-start" alt="pegi">
                        <p>Age: <?php echo $game['label'] . "+" ?></p>
                    </div>
                    <div class="avis">
                        <span>Avis presse: <?php echo $game['note_media'] . "/20" ?></span>
                        <span>Avis utilisateur: <?php echo $game['note_utilisateur']  . "/20" ?></span>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php
}
?>
<?php

function render_console($console)
{
?>

    <a href="#" class="console"><?php echo $console['label'] ?></a>
<?php

}


?>