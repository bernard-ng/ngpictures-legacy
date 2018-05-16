<?php
require SRC . "/init.php";

if (isset($_SESSION['id']) and !empty($_SESSION['id'])) {
    $verif = $db->prepare("SELECT * FROM membres WHERE id=? ");
    $verif->execute(array($_SESSION['id']));
    $user = $verif->fetch();

    if (isset($_POST['modifier'])) {
        if (!empty($_POST)) {
            if (isset($_POST['pseudoupdate']) and !empty($_POST['pseudoupdate']) and $_POST['pseudoupdate'] != $user['pseudo']) {
                $pseudoupdate = htmlspecialchars($_POST['pseudoupdate']);

                if (preg_match("#([^a-zA-Z0-9_]+)#", $pseudoupdate)) {
                    $msg = "le Pseudo doit contenir uniquement des lettres(non accentuées), des chiffres et des __underscores__";
                    $type = "alert-danger";

                } else {

                    $pseudoupdate = htmlspecialchars($_POST['pseudoupdate']);
                    $pseudoupdate = strtolower($pseudoupdate);

                    $verif = $db->prepare("SELECT * FROM membres WHERE pseudo = ?");
                    $verif->execute(array($pseudoupdate));
                    $pseudoExist = $verif->rowCount();

                    if ($pseudoExist == 0) {
                        $updateNAME = $db->prepare("UPDATE membres SET pseudo = ? WHERE id=?");
                        $updateNAME->execute(array($pseudoupdate, $_SESSION['id']));

                        $_SESSION['msg'] = "Pseudo mis à jour !";
                        $_SESSION['type'] = "alert-success";
                        header("location:profil.php?id=" . $_SESSION['id']);

                    } else {

                        $msg = "Ce pseudo est dejà pris !";
                        $type = "alert-danger";
                    }
                }
            }

            if (isset($_POST['numupdate']) and !empty($_POST['numupdate']) and $_POST['numupdate'] != $user['num']) {
                // trop compliquer pour moi..., du coup le code en bas ne marche pas comme prevu
                if (substr($_POST['numupdate'], 0, 1) == "+") {
                    $numupdate = str_replace("#^(\+)+#", "00", $_POST['numupdate']);
                    $numupdate = htmlspecialchars($numupdate);
                    $updateNAME = $db->prepare("UPDATE membres SET num = ? WHERE id=?");
                    $updateNAME->execute(array($numupdate, $_SESSION['id']));

                    $_SESSION['msg'] = "Numéro Mobile à jour";
                    $_SESSION['type'] = "alert-success";
                    header("location:profil.php?id=" . $_SESSION['id']);

                } else {

                    $msg = "Veuillez indiquer le code téléphonique avec un '+' ";
                    $type = "alert-danger";
                }
            }

            if (isset($_POST['mdpupdate']) and !empty($_POST['mdpupdate']) and isset($_POST['mdp1update']) and !empty($_POST['mdp1update'])) {

                $mdpupdate = sha1($_POST['mdpupdate']);
                $mdp1update = sha1($_POST['mdp1update']);
                $mdp_len = iconv_strlen($_POST['mdp1update']);

                if ($mdpupdate == $user['mdp']) {
                    if ($mdp_len >= 8) {
                        $updatePASS = $db->prepare("UPDATE membres SET mdp = ? WHERE id= ?");
                        $updatePASS->execute(array($mdp1update, $_SESSION['id']));

                        $_SESSION['msg'] = "Mot de passe mis à jour !";
                        $_SESSION['type'] = "alert-success";
                        header("location:profil.php?id=" . $_SESSION['id']);

                    } else {
                        $msg = "Votre mot de passe doit faire au moins 8 caratères";
                        $type = "alert-danger";
                    }
                } else {
                    $msg = "Mauvais mot de passe";
                    $type = "alert-danger";
                }
            }

            if (isset($_FILES['avatar']) and !empty($_FILES['avatar']['name'])) {
                $sizeMax = 10485760;
                $admitExt = array("jpg", "jpeg");

                if ($_FILES['avatar']['size'] <= $sizeMax) {
                    $Extupload = strtolower(substr(strrchr($_FILES['avatar']['name'], "."), 1));

                    if (in_array($Extupload, $admitExt)) {
                        include '../src/class/imgClass.php';
                        $img = '$_SESSION["id"]' . '.' . '$Extupload';
                        $way = "Avatar/" . $_SESSION['id'] . "." . $Extupload;
                        $way2 = "Avatar/40-40/" . $_SESSION['id'] . "." . $Extupload;
                        $way3 = "Avatar/90-90/" . $_SESSION['id'] . "." . $Extupload;
                        $way4 = "Avatar/640-640/" . $_SESSION['id'] . "." . $Extupload;

                        $result = move_uploaded_file($_FILES['avatar']['tmp_name'], $way);

                        if ($result) {
                            Img::creerMIn($way, $way2, $img, 40, 40);
                            Img::creerMIn($way, $way3, $img, 90, 90);
                            Img::creerMIn($way, $way4, $img, 640, 640);

                            $update = $db->prepare("UPDATE membres SET avatar = :avatar WHERE id= :id");
                            $update->execute(
                                array(
                                "avatar" => $_SESSION['id'] . "." . $Extupload,
                                "id" => $_SESSION['id']
                                )
                            );

                            $_SESSION['msg'] = "Profil mis à jour !";
                            $_SESSION['type'] = "alert-success";
                            header("location:profil.php?id=" . $_SESSION['id']);

                        } else {

                            $msg = "Erreur dans l'importation de la photo !";
                            $type = "alert-danger";
                        }
                    } else {

                        $msg = "Votre photo doit être au format  jpg ou jpeg !";
                        $type = "alert-danger";
                    }
                } else {

                    $msg = "Votre photo ne doit pas dépasser 10Mo";
                    $type = "alert-danger";
                }
            }

            if (isset($_POST['statut']) and !empty($_POST['statut'])) {
                if (preg_match("#^(.+)$#", $_POST['statut'])) {
                    if (preg_match("#^([a-zA-Z]+)#", $_POST['statut'])) {
                        $statut = htmlspecialchars($_POST['statut']);
                        $Newstatut = $db->prepare("UPDATE membres SET statut = ? where id=" . $_SESSION['id']);
                        $Newstatut->execute(array($statut));
                        $userInfo = $Newstatut->fetch();

                        $_SESSION['msg'] = "Statut mis à jour !";
                        $_SESSION['type'] = "alert-success";
                        header("location:profil.php?id=" . $_SESSION['id']);

                    } else {

                        $msg = " Le statut doit commencer avec une lettre !";
                        $type = "alert-danger";
                    }

                } else {

                    $msg = "Le statut ne doit pas commencer avec un retour à la ligne!";
                    $type = "alert-danger";
                }
            }
        }
    }

} else {

    $_SESSION['msg'] = "vous devez vous connecter !";
    $_SESSION['type'] = "alert-danger";
    header("location:pages/membres/login.php");
}

?>
