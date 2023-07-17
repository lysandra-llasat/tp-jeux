<?php
function get_all_games()
{
    global $connection;

    $query = "SELECT j.id, j.titre, j.prix, j.image_path, j.age_id, ra.image_path, j.image_path AS image_jeux
        FROM jeu as j 
        INNER JOIN restriction_age AS ra
        ON j.age_id = ra.id";

    if ($result = mysqli_query($connection, $query)) {
        if (mysqli_num_rows($result) > 0) {
            while ($game = mysqli_fetch_assoc($result)) {
                //ici le rendu html d'un jouet 
                render_game($game);
            }
        } else { ?>
            <div class="alert alert-warning" role="alert">
                aucun jeux trouvé
            </div>

            <?php
        }
    }
};

function get_username($user)
{
    global $connection;

    $query = "SELECT user.username
    FROM user ";
    if ($result = mysqli_query($connection, $query)) {
        if (mysqli_num_rows($result) > 0) {
            while ($user = mysqli_fetch_assoc($result)) {
            ?>
                <span><?php echo $user['username'] ?></span>
            <?php
            }
        }
    }
}

function get_game_detail($game_id)
{

    global $connection;

    $query = "SELECT j.id, 
    j.titre, 
    j.prix,
    j.description, 
    j.image_path, 
    j.date_sortie,
    j.age_id,
    ra.label,
    n.note_media,
    n.note_utilisateur, 
    ra.image_path AS image_age
    FROM jeu as j
    INNER JOIN restriction_age AS ra
    ON j.age_id = ra.id
    INNER JOIN note AS n
    ON j.note_id = n.id
    WHERE j.id = $game_id";

    if ($result = mysqli_query($connection, $query)) {
        if (mysqli_num_rows($result) > 0) {
            while ($game = mysqli_fetch_assoc($result)) {
                //ici le rendu html d'un jouet 
                render_detail($game);
            }
        } else { ?>
            <div class="alert alert-warning" role="alert">
                aucun détail de jeux trouvé
            </div>

        <?php
        }
    }
};

function get_console($jeu_id)
{
    global $connection;

    $query = "SELECT c.id, j.id AS jeux_id, c.label
    FROM game_console AS gc 
    INNER JOIN console AS c
    ON gc.console_id = c.id
    INNER JOIN jeu AS j
    ON gc.jeu_id = j.id
    WHERE j.id = $jeu_id";

    $result = mysqli_query($connection, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        while ($console = mysqli_fetch_assoc($result)) {
            render_console($console);
        }
    } else {
        ?>
        <div class="alert alert-warning" role="alert">
            Aucune console trouvée !!
        </div>
        <?php
    }
}

function get_store()
{
    global $connection;

    //on crée la requete 
    $query = "SELECT name, id FROM stores";

    //on execute la requete
    if ($result = mysqli_query($connection, $query))
        if (mysqli_num_rows($result) > 0) {
            //on parcour le resultat
            while ($store = mysqli_fetch_assoc($result)) {
                //on appele la fonction de rendu html
        ?>
            <li><a class="dropdown-item" href="../store.php?store_id=<?php echo $store['id'] ?>"><?php echo $store['name'] ?></a></li>
        <?php
                //lorsque l'on echo la variable dans whild on donne des parametre dynamique
                //il sont directement récupere dans la base de données a chauqe fois qua la boucle s'effectue

            }
        }
};

function get_game_by_console()
{

    global $connection;

    //on crée la requete 
    $query = "SELECT 
        c.id, 
        c.label ,
        COUNT(j.id)
    FROM game_console AS gc 
        INNER JOIN console AS c 
        ON gc.console_id = c.id 
        INNER JOIN jeu AS j 
        ON gc.jeu_id = j.id 
    where c.id = gc.console_id
    GROUP BY c.id";

    //on execute la requete 
    //on execute la requete
    if ($result = mysqli_query($connection, $query))
        if (mysqli_num_rows($result) > 0) {
            //on parcour le resultat
            while ($console = mysqli_fetch_assoc($result)) {
                //on appele la fonction de rendu html
        ?>
            <li><a class="dropdown-item bg-primary text-white" href="../game_by_console.php?console_id=<?php echo $console['id'] ?> "><?php echo $console['label'] ?> <span> (<?php echo $console['COUNT(j.id)'] ?>)</span></a></li>
        <?php
                //lorsque l'on echo la variable dans whild on donne des parametre dynamique
                //il sont directement récupere dans la base de données a chauqe fois qua la boucle s'effectue

            }
        }
}

function get_game_by_age()
{

    global $connection;

    //on crée la requete 
    $query = "SELECT
    ra.id,
    ra.label,
    ra.image_path,
    COUNT(j.id)
    FROM restriction_age AS ra
    INNER JOIN jeu AS j
    ON ra.id = j.age_id
    GROUP BY ra.id";

    //on execute la requete 
    //on execute la requete
    if ($result = mysqli_query($connection, $query))
        if (mysqli_num_rows($result) > 0) {
            //on parcour le resultat
            while ($age = mysqli_fetch_assoc($result)) {
                //on appele la fonction de rendu html
        ?>
            <li><a class="dropdown-item bg-primary text-white" href="../page-age.php?age_id=<?php echo $age['id'] ?> "> Age : <img class="small-pegi" src="../images/pegi/<?php echo $age['image_path'] ?>" alt=""> <span> (<?php echo $age['COUNT(j.id)'] ?>)</span> </a></li>
        <?php
                //lorsque l'on echo la variable dans whild on donne des parametre dynamique
                //il sont directement récupere dans la base de données a chauqe fois qua la boucle s'effectue

            }
        }
}

function get_all_game_desc()
{

    global $connection;

    //on crée la requete 
    $query = "SELECT j.id, j.titre, j.prix, j.image_path AS image_jeux, j.age_id, j.image_path 
    FROM jeu as j 
    ORDER BY j.prix DESC";

    if ($result = mysqli_query($connection, $query)) {
        if (mysqli_num_rows($result) > 0) {
            while ($game = mysqli_fetch_assoc($result)) {
                //ici le rendu html d'un jouet 
                render_game($game);
            }
        } else { ?>
            <div class="alert alert-warning" role="alert">
                aucun jeux trouvé
            </div>

        <?php
        }
    }
}

function get_all_note_user_desc()
{

    global $connection;

    //on crée la requete 
    $query = "SELECT
        j.id,
        j.titre,
        j.prix,
        j.image_path AS image_jeux,
        j.age_id,
        n.note_utilisateur,
        n.note_media
    FROM jeu as j
    INNER JOIN note AS n 
    ON j.note_id = n.id
    ORDER BY n.note_utilisateur DESC";

    if ($result = mysqli_query($connection, $query)) {
        if (mysqli_num_rows($result) > 0) {
            while ($game = mysqli_fetch_assoc($result)) {
                //ici le rendu html d'un jouet 
                render_game_user($game);
            }
        } else { ?>
            <div class="alert alert-warning" role="alert">
                aucun jeux trouvé
            </div>

        <?php
        }
    }
}

function get_all_note_media_desc()
{

    global $connection;

    //on crée la requete 
    $query = "SELECT
        j.id,
        j.titre,
        j.prix,
        j.image_path AS image_jeux,
        j.age_id,
        n.note_utilisateur,
        n.note_media
    FROM jeu as j
    INNER JOIN note AS n 
    ON j.note_id = n.id
    ORDER BY n.note_media DESC";

    if ($result = mysqli_query($connection, $query)) {
        if (mysqli_num_rows($result) > 0) {
            while ($game = mysqli_fetch_assoc($result)) {
                //ici le rendu html d'un jouet 
                render_game_user($game);
            }
        } else { ?>
            <div class="alert alert-warning" role="alert">
                aucun jeux trouvé
            </div>

        <?php
        }
    }
}

function get_all_game_asc()
{

    global $connection;

    //on crée la requete 
    $query = "SELECT j.id, j.titre, j.prix, j.image_path AS image_jeux, j.age_id, j.image_path 
    FROM jeu as j 
    ORDER BY j.prix ASC";

    if ($result = mysqli_query($connection, $query)) {
        if (mysqli_num_rows($result) > 0) {
            while ($game = mysqli_fetch_assoc($result)) {
                //ici le rendu html d'un jouet 
                render_game($game);
            }
        } else { ?>
            <div class="alert alert-warning" role="alert">
                aucun jeux trouvé
            </div>

            <?php
        }
    }
}

function get_all_game_by_console($console_id)
{
    //on récupere la connexion a la base de données
    global $connection;

    $query = "SELECT j.titre, 
     j.description, 
     j.prix, 
     j.date_sortie, 
     j.image_path AS image_jeux, 
     j.id, 
     gc.console_id
     FROM game_console AS gc
     INNER JOIN jeu AS j
     ON j.id = gc.jeu_id 
     INNER JOIN console AS c
     ON c.id = gc.console_id
     WHERE c.id = ?";

    //on prépare la requete
    if ($stmt = mysqli_prepare($connection, $query)) {
        //on rentre dans le contexte d'une requete préparer

        //on doit binder les parametre (on doit expliquer a php ce que sont les ?)
        mysqli_stmt_bind_param(
            $stmt, // on lui donne la resuet préparer( la variable qui est devant mysqli_prepare)
            'i', // on lui donne les types de paramètres de chque ? (i = integer, s = string, d = double)
            $console_id //on lui donne la valeur des ? dans l'ordre
        );

        //on execute la requete
        if (mysqli_stmt_execute($stmt)) {
            //on recupere le resultat de la requete

            $result = mysqli_stmt_get_result($stmt);
            //on vérifie que l'on a des résultat

            if (mysqli_num_rows($result) > 0) {
                //on parcours les resultat
                while ($game = mysqli_fetch_assoc($result)) {


                    render_game($game);
                }
            }
        }
    }
}

function get_all_game_by_age($age_id)
{
    //on récupere la connexion a la base de données
    global $connection;

    $query = "SELECT j.titre, 
    j.description, 
    j.prix, 
    j.date_sortie, 
    j.image_path AS image_jeux, 
    j.id, 
   ra.id, 
   ra.label
    FROM jeu AS j 
    INNER JOIN restriction_age AS ra 
    ON j.age_id = ra.id
    WHERE ra.id = ?";

    //on prépare la requete
    if ($stmt = mysqli_prepare($connection, $query)) {
        //on rentre dans le contexte d'une requete préparer

        //on doit binder les parametre (on doit expliquer a php ce que sont les ?)
        mysqli_stmt_bind_param(
            $stmt, // on lui donne la resuet préparer( la variable qui est devant mysqli_prepare)
            'i', // on lui donne les types de paramètres de chque ? (i = integer, s = string, d = double)
            $age_id //on lui donne la valeur des ? dans l'ordre
        );

        //on execute la requete
        if (mysqli_stmt_execute($stmt)) {
            //on recupere le resultat de la requete

            $result = mysqli_stmt_get_result($stmt);
            //on vérifie que l'on a des résultat

            if (mysqli_num_rows($result) > 0) {
                //on parcours les resultat
                while ($game = mysqli_fetch_assoc($result)) {


                    render_game($game);
                }
            }
        }
    }
}

function get_age_form()
{
    global $connection;

    $query = "SELECT * FROM restriction_age ";


    //on execute la requete
    if ($result = mysqli_query($connection, $query)) {
        if (mysqli_num_rows($result) > 0) {
            //on parcour le resultat
            while ($age = mysqli_fetch_assoc($result)) {
                //on appele la fonction de rendu html
            ?>
                <option value="<?php echo $age['id'] ?> "><?php echo $age['label'] ?> + </option>
            <?php
                //lorsque l'on echo la variable dans whild on donne des parametre dynamique
                //il sont directement récupere dans la base de données a chauqe fois qua la boucle s'effectue

            }
        }
    }
}

function get_console_form()
{
    global $connection;

    $query = "SELECT * FROM console ";


    //on execute la requete
    if ($result = mysqli_query($connection, $query)) {
        if (mysqli_num_rows($result) > 0) {
            //on parcour le resultat
            while ($console = mysqli_fetch_assoc($result)) {
                //on appele la fonction de rendu html
            ?>
                <input type="checkbox" name="console[]" class="btn-check" id="btncheck<?php echo $console['id'] ?>" value="<?php echo $console['id'] ?>" autocomplete="off">
                <label class="btn btn-outline-primary " for="btncheck<?php echo $console['id'] ?>"><?php echo $console['label'] ?></label>
<?php
                //lorsque l'on echo la variable dans whild on donne des parametre dynamique
                //il sont directement récupere dans la base de données a chauqe fois qua la boucle s'effectue

            }
        }
    }
}
