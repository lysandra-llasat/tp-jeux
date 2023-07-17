<?php
require_once "./config.php";

global $connection;

var_dump($_POST);
var_dump($_FILES);

$uploadDirectory = "../images/games/";
if (
    isset($_POST['titre']) &&
    isset($_POST['price']) &&
    isset($_POST['description']) &&
    isset($_POST['date']) &&
    isset($_POST['age']) &&
    isset($_POST['console']) &&
    isset($_POST['note_utilisateur']) &&
    isset($_POST['note_presse']) &&
    isset($_FILES['image'])


) {
    $tmpFIlePath = $_FILES['image']['tmp_name'];
    //on renomme le nom du fichier pour qu'il soit unique
    $filename = $_FILES['image']['name'];
    $uniqFilename = uniqid() . '-' . $filename;
    $destinationFinale = $uploadDirectory . $uniqFilename;
    var_dump($destinationFinale);

    $titre = $_POST['titre'];
    $prix = intval($_POST['price']);
    $description = $_POST['description'];
    $date = $_POST['date'];
    var_dump($date);
    die;
    $age = $_POST['age'];
    $console = $_POST['console'];
    $note_utilisateur = intval($_POST['note_utilisateur']);
    $note_presse = intval($_POST['note_presse']);



    if (move_uploaded_file($tmpFIlePath, $destinationFinale)) {

        //1 insere les note dans la table note 
        $query = "INSERT INTO note (note_utilisateur, note_media) VALUES (?,?)";
        if ($stmt = mysqli_prepare($connection, $query)) {
            mysqli_stmt_bind_param(
                $stmt,
                "ii",
                $note_presse,
                $note_utilisateur

            );
        }
        //2 recupere l'id de la ligne crée de la ligne note 
        mysqli_stmt_execute($stmt);
        $age_id = mysqli_insert_id($connection);
        //3 insere dans la tale jeux
        $query2 = "INSERT INTO jeu (titre, prix, description, date_sortie, age_id, image_path) VALUES (?,?,?,?,?,?)";
        if ($stmt2 = mysqli_prepare($connection, $query2)) {
            mysqli_stmt_bind_param(
                $stmt2,
                "sisiis",
                $titre,
                $prix,
                $description,
                $date,
                $age_id,
                $uniqFilename

            );
            mysqli_stmt_execute($stmt2);
            $jeux_id = mysqli_insert_id($connection);
            mysqli_stmt_close($stmt2);

            $query3 = 'INSERT INTO game_console(console_id, jeu_id) VALUES(?,?)';

            for ($i = 0; $i <= count($console); $i++) {
                if ($stmt3 = mysqli_prepare($connection, $query3)) {
                    mysqli_stmt_bind_param(
                        $stmt3,
                        "ii",
                        $console[$i],
                        $jeux_id

                    );
                    mysqli_stmt_execute($stmt3);
                }

                header("Location: index.php?success=Fichier uploader avec succès");
            };
            //4 recupere l'id de la ligne du jeux 
            //insere dans la table game-console
        }
    }
}
