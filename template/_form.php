<?php
function form($title, $action, $button_name, $text, $link, $button_link)
{

?>
    <div>
        <form class="form" action="<?php echo $action ?>" method="post">
            <h2><?php echo $title ?></h2>
            <div class="mb-3">
                <label for="email" class="form-label">Indiquez votre email</label>
                <input type="text" name="email" placeholder="Votre email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                <div id="emailHelp" class="form-text">Votre email ne seras pas communiquer</div>
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
                <button type="submit" class="btn btn-primary"><?php echo $button_name ?></button>
                <p class="sub_text"><?php echo $text ?>
                    <a href="<?php echo $link ?>" class="link"><?php echo $button_link ?></a>
                </p>
            </div>
            <p></p>
    </div>
<?php
}
?>