
<?php
require_once "./config.php";
require_once "../tools/function.php";


//on vérifie que l'on recois bien les données du formulaire 
if (isset($_POST['email']) && isset($_POST['password'])) {
    //on crée une fonction qui va séuriser les données recus 


    //on crée nos variable qui vont contenir les données sécurise 
    $email = strtolower(validate($_POST['email']));
    $password = validate($_POST['password']);
    $username = validate($_POST['username']);
    // le nom de la variable doit etre identique au name de l'input 
    //on doit encoder le password !! obligatoire interdiction de stocker des mot de passe en claire dans une application
    $pass_hash = password_hash($password, PASSWORD_BCRYPT);
    // var_dump($password);
    // var_dump($pass_has);
    var_dump($username);

    //maintenant que nos données sont receptionne et sécurisées
    //on va effectuer plusieur traitements
    // 5-gestion des erreurs 
    if (empty($email)) {
        //on renvoie en GET a index.php le parametre "?error=veuillez saisir l'email"
        header("Location:../inscription.php?error=veillez saisir l'email");
        exit();
    } else if (empty($password)) {
        header("Location: ../inscription.php?error=veuillez saisir le mot de passe");
        exit();
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: ../inscription.php?error=veuillez saisir un email valide");
        exit();
    } else if (empty($username)) {
        header("Location:../inscription.php?error=veillez remplir l'username");
    } else {
        //todo 1: on vérifie que l'email n'existe pas deja dans la BDD
        //on doit récuperer la variable de conexion a la BDD
        global $connection;
        //on crée la requete sql 
        $query_get_email = "SELECT * FROM user WHERE email = '$email'";
        $query_get_username = "SELECT * FROM user WHERE username = '$username'";


        if ($result = mysqli_query($connection, $query_get_email)) {
            //on regarde si on a un resultat qui sort
            if (mysqli_num_rows($result) > 0) {
                //si on a un resultat on renvoie un message d'erreur 
                header("Location: ../inscription.php?error=cette email exist déjà");
                exit();
            }
        if ($result2 = mysqli_query($connection, $query_get_username)) {
                //on regarde si on a un resultat qui sort
                if (mysqli_num_rows($result2) > 0) {
                    //si on a un resultat on renvoie un message d'erreur 
                    header("Location: ../inscription.php?error=cette username existe deja");
                    exit();
                } else {
                    //todo 2: inserer dans la BDD

                    //on crée la requete sql 
                    $query_post = "INSERT INTO user (email, password, username)
                VALUE ('$email','$pass_hash','$username')";
                    if (mysqli_query($connection, $query_post)) {
                        //si l'insertion est bien faite on récupere l'utilisateur 
                        //pour créer la session 
                        if ($new_result = mysqli_query($connection, $query_get_email)) {
                            while ($new_user = mysqli_fetch_assoc($new_result)) {
                                if ($new_user['email'] === $email && $new_user['password'] === $pass_hash && $new_user['username'] === $username) {
                                    //on cré une session 
                                    session_start();
                                    //on va stocker l'email et id de l'utilisateur dans la session 
                                    $_SESSION['email'] = $new_user['email'];
                                    $_SESSION['id'] = $new_user['id'];
                                    $_SESSION['username'] = $new_user['username'];

                                    mysqli_close($connection);
                                    //on redirige sur la page home.php
                                    header("Location: ../index.php");
                                }
                            }
                        }
                    }
                }
            } else {
                header("Location: ../index.php?error=erreur de conexion a la BDD");
                exit();
            }
            //todo 3: pour tout les cas, on gere les erreur 
        }
    }
}
