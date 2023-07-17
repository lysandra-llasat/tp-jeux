<?php require_once './config.php' ?>
<?php require_once '../tools/function.php' ?>

<?php


var_dump($_POST);

//on vérifie que l'on recois bien les données du formulaire 
if (isset($_POST['email']) && isset($_POST['password'])) {
    //on crée une fonction qui va séuriser les données recus 


    var_dump(validate($_POST['email']) && isset($_POST['password']));

    //on crée nos variable qui vont contenir les données sécurise 
    $email = strtolower(validate($_POST['email']));
    $password = validate(validate($_POST['password']));
    // le nom de la variable doit etre identique au name de l'input 
    //on doit encoder le password !! obligatoire interdiction de stocker des mot de passe en claire dans une application

    //maintenant que nos données sont receptionne et sécurisées
    //on va effectuer plusieur traitements
    // 5-gestion des erreurs 
    if (empty($email)) {
        //on renvoie en GET a index.php le parametre "?error=veuillez saisir l'email"
        header("Location:../login.php?error=veillez saisir l'email");
        exit();
    } else if (empty($password)) {
        header("Location: ../login.php?error=veuillez saisir le mot de passe");
        exit();
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: ../login.php?error=veuillez saisir un email valide");
        exit();
    } else {
        //on va vérifier que l'utilisateur existe dans la BDD
        global $connection;
        //on crée la requete sql 
        $query = "SELECT * FROM user WHERE email = '$email'";
        //on execute la requete 
        if ($result = mysqli_query($connection, $query)) {
            //on regarde si on a un résultat qui sort
            if (mysqli_num_rows($result) < 1) {
                //si on apas de résultat on renvoie un message d'erreur 
                header("Location: ../login.php?error=Email et/ou mot de passe incorect");
                exit();
            }
            //si on a un résultat on vérifie le combo email/mot de passe 
            while ($user = mysqli_fetch_assoc($result))
                if ($user['email'] == $email && password_verify($password, $user['password'])) {
                    //on crée la session 
                    session_start();
                    //on stock en session l'mail et l'id de l'utilisateur 
                    $_SESSION['email'] = $user['email'];
                    $_SESSION['id'] = $user['id'];
                    $_SESSION['username'] = $user['username'];

                    mysqli_close($connection);
                    //on redirige vers la page home
                    header("Location: ../index.php");
                } else {
                    header("Location: ../login.php?error=Email et/ou mot de passe incorrect");
                    exit();
                }
        }
    };
}
