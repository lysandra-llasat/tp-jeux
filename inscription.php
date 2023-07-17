<?php require_once './template/_header.php' ?>
<?php require_once './template/_form.php' ?>

<img class="logo" src="/images/logo.png" alt="logo">


<?php

// form(
//     "Créer un compte",
//     "./requete/registration.php",
//     "s'enregistrer",
//     "vous avez deja un compte ?",
//     "login.php",
//     "connectez-vous"

// );

?>
<div>
    <form class="form" action="./requete/registration.php" method="post">
        <h2> Créer un compte </h2>
        <div class="mb-3">
            <label for="email" class="form-label">Indiquez votre email</label>
            <input type="text" name="email" placeholder="Votre email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
            <div id="emailHelp" class="form-text">Votre email ne seras pas communiquer</div>
        </div>
        <div class="mb-3">
            <label for="text" class="form-label">Nom d'utilisateur</label>
            <input type="text" name="username" placeholder="Rentré un nom d'utilisateur" class="form-control" id="exampleInputPassword1">
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Mot de passe</label>
            <input type="password" name="password" placeholder="votre mot de passe" class="form-control" id="exampleInputPassword1">
        </div>
        <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="exampleCheck1">
            <label class="form-check-label" for="exampleCheck1">Check me out</label>
        </div>
        <div class="box_button">
            <button type="submit" class="btn btn-primary">s'enregistrer</button>
            <p class="sub_text">vous avez deja un compte ?
                <a href="./login.php" class="link">connectez-vous</a>
            </p>
        </div>
        <p></p>
</div>
<?php



require_once './template/_footer.php' ?>