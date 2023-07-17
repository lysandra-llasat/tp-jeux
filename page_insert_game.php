<?php require_once './template/_header.php' ?>
<?php require_once './template/_game.php' ?>
<?php require_once './requete/config.php' ?>
<?php require_once './requete/get_game.php' ?>


<?php require_once './template/_navbar.php' ?>

<div>
    <form class="form" action="./requete/upload.php" method="post" enctype="multipart/form-data">
        <h2> Enregistre un nouveau jeux </h2>
        <div class="mb-3">
            <label for="email" class="form-label">Indiquez le nom du jeux </label>
            <input type="text" name="titre" placeholder="nom" class="form-control">
        </div>
        <div class="mb-3">
            <label for="text" class="form-label">indiquez le prix</label>
            <input type="text" name="price" placeholder="prix" class="form-control"">
        </div>

        <div class=" mb-3 d-flex flex-column">
            <label for="text" class="form-label">indiquez la description</label>
            <textarea name="description" id="" placeholder="description" cols="30" rows="10"></textarea>
        </div>

        <div class=" mb-3 d-flex flex-column">
            <label for="text" class="form-label">indiquez la date de sortie</label>
            <input type="datetime-local" name="date" id="">
        </div>

        <div class=" mb-3 d-flex flex-column">
            <label for="text" class="form-label">indiquez la limite d'âge</label>
            <select name="age" id=""> <?php get_age_form() ?></select>
        </div>

        <label for="text" class="form-label">indiquez les consoles</label>
        <div class="btn-group" role="group" aria-label="Basic checkbox toggle button group">
            <?php
            get_console_form()
            ?>
        </div>
        <div class=" mb-3 d-flex flex-column">
            <label for="text" class="form-label">indiquez la note utilisateur</label>
            <input type="text" name="note_utilisateur" placeholder="note" class="form-control"">
            <label for=" text" class="form-label">indiquez la note presse</label>
            <input type="text" name="note_presse" placeholder="note" class="form-control"">
        </div>


        <div class=" mb-3">
            <label for="file" class="form-label">Entré l'image</label>
            <input type="file" name="image" placeholder="image" class="form-control">
        </div>

        <div class=" box_button">
            <button type="submit" class="btn btn-primary">enregistrer</button>
        </div>
</div>


<?php require_once './template/_footer.php' ?>