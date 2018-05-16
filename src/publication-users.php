<?php
require SRC . "/init.php";

$editionMODE = 0;

if (isset($_SESSION['id']) and !empty($_SESSION['id'])) {
    $idd = htmlspecialchars($_SESSION['id']);
    $userID = $db->prepare("SELECT * from membres where id= ?");
    $userID->execute(array($idd));
    $verif = $userID->fetch();
    $userPseudo = $verif['pseudo'];
    $userid = $verif['id'];


    if (isset($_GET['edit']) and !empty($_GET['edit'])) {
        $editionMODE = 1;
        $editID = htmlspecialchars($_GET['edit']);
        $articleEDIT = $db->prepare("SELECT * from article where id=?");
        $articleEDIT->execute(array($editID));

        if ($articleEDIT->rowcount() == 1) {
            $articleEDIT = $articleEDIT->fetch();
        } else {
            header("location:pages/plus/erreur/404.php");
        }
    }

    if (isset($_POST['titre'], $_POST['contenu'])) {
        if (!empty($_POST['titre']) and !empty($_POST['contenu'])) {
            $titre = htmlspecialchars($_POST['titre']);
            $contenu = htmlspecialchars($_POST['contenu']);
            $poster = htmlspecialchars($userPseudo);
            $posterID = htmlspecialchars($userid);
            if ($editionMODE == 0) {
                if (isset($_FILES['miniature']) and !empty($_FILES['miniature']['name'])) {
                    $insert = $db->prepare('INSERT into article (titre,contenu,date_pub,posterID)   values (?,?,NOW(),?)');
                    $insert->execute(array($titre, $contenu, $posterID));
                    $lastID = $db->lastInsertId();
                    $admitExt = array("jpg", "jpeg");
                    $Extupload = strtolower(substr(strrchr($_FILES['miniature']['name'], "."), 1));

                    if (in_array($Extupload, $admitExt)) {

                        include '../src/class/imgClass.php'; // on cree de miniature et on les envoi dans les different dossier
                        $img = '$lastID' . '.' . '$Extupload';
                        $name = $lastID . '.' . $Extupload;
                        $way = "miniature/" . $lastID . "." . $Extupload;
                        $way2 = "miniature/40-40/" . $lastID . "." . $Extupload;
                        $way3 = "miniature/90-90/" . $lastID . "." . $Extupload;
                        $way4 = "miniature/640-640/" . $lastID . "." . $Extupload;

                        $result = move_uploaded_file($_FILES['miniature']['tmp_name'], $way);

                        if ($result) {
                            Img::creerMIn($way, $way2, $img, 40, 40);
                            Img::creerMIn($way, $way3, $img, 90, 90);
                            Img::creerMIn($way, $way4, $img, 640, 640);


                            $_SESSION['msg'] = "votre article a bien été posté !";
                            $_SESSION['type'] = "alert-success";

                            $insert2 = $db->prepare('UPDATE article  set miniature = ?  where id= ?');
                            $insert2->execute(array($name, $lastID));
                            header("location:/actualite");

                        } else {

                            $msg = "Erreur dans l'importation de la photo !";
                            $del = $db->prepare('DELETE from article where id= ?');
                            $del->execute(array($lastID));
                        }

                    } else {

                        $msg = "Votre photo doit être au format jpg ou jpeg";
                        $type = "alert-danger";
                    }

                } else {

                    $msg = "L'article doit avoir une photo de couverture";
                    $type = "alert-danger";
                }

            } else {

                $update = $db->prepare("UPDATE article set titre=?,contenu=?,date_edition= now() where id=?");
                $update->execute(array($titre, $contenu, $editID));

                $_SESSION['msg'] = "Votre article à bien été mis à jour";
                $_SESSION['type'] = "alert-success";
                header("location:/actualite");
            }
        } else {
            $msg = "complétez tous les champs";
            $type = "alert-danger";
        }
    }

    //publication des photos

    if (isset($_FILES['image']) and !empty($_FILES['image']['name'])) {
        $tags = htmlspecialchars($_POST['tags']);
        $sizeMax = 10485760;
        $admitExt = array("jpg", "jpeg");

        if ($_FILES['image']['size'] <= $sizeMax) {
            $Extupload = strtolower(substr(strrchr($_FILES['image']['name'], "."), 1));
            if (in_array($Extupload, $admitExt)) {
                include '../src/class/imgClass.php';
                $img = "Ngpictures_" . $_FILES['image']['name'];
                $way = "..pages/galerie/images/miniature/Ngpictures_" . $_FILES['image']['name'];
                $way2 = "..pages/galerie/images/40-40/Ngpictures_" . $_FILES['image']['name'];
                $way3 = "..pages/galerie/images/90-90/Ngpictures_" . $_FILES['image']['name'];
                $way4 = "..pages/galerie/images/640-640/Ngpictures_" . $_FILES['image']['name'];

                $result = move_uploaded_file($_FILES['image']['tmp_name'], $way);

                if ($result) {
                    Img::creerMIn($way, $way2, $img, 40, 40);
                    Img::creerMIn($way, $way3, $img, 90, 90);
                    Img::creerMIn($way, $way4, $img, 640, 640);

                    $ins = $db->prepare("INSERT INTO galerie(userID,date_pub,tags,nom) values(?,now(),?,?) ");
                    $ins->execute(array($_SESSION['id'], $tags, $img));

                    $_SESSION['msg'] = "Photo postée";
                    $_SESSION['type'] = "alert-success";
                    header("location:../galerie?id=" . $_SESSION['id']);

                } else {
                    $msg1 = "Erreur dans l'importation de la photo !";
                    $type = "alert-danger";
                }
            } else {
                $msg1 = "Votre photo doit être au format  jpg ou jpeg !";
                $type = "alert-danger";
            }
        } else {
            $msg1 = "Votre photo ne doit pas dépasser 10Mo";
            $type = "alert-danger";
        }
    }

} else {
    header("location:pages/membres/login.php");
    $_SESSION['msg'] = "vous devez vous connecter !";
    $_SESSION['type'] = "alert-danger";
}
?>
