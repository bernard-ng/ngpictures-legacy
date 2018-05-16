<?php
require(SRC . "/init.php");



if (isset($_SESSION['id']) and !empty($_SESSION['id'])) {
    $_SESSION["msg"] = "vous avez dejà un compte !";
    $_SESSION["type"] = "alert-warning";
    header("location:pages/membres/profil.php?id=" . $_SESSION['id']);

} else {
    if (isset($_POST['creer'])) {
        $name = ucfirst(htmlspecialchars($_POST['name']));
        $statut = "Hey tout le monde suis sur #Ngpictures...";
        $pseudo = strtolower(htmlspecialchars($_POST['pseudo']));
        $email = htmlspecialchars($_POST['email']);
        $mdpt1 = htmlspecialchars($_POST['mdp']);
        $mdpt = htmlspecialchars($_POST['mdp1']);
        $mdp = sha1($_POST['mdp']);
        $mdp1 = sha1($_POST['mdp1']);

        if (!empty($_POST["name"]) && !empty($_POST['pseudo']) && !empty($_POST['email']) && !empty($_POST['mdp']) && !empty($_POST['mdp1'])) {
            if (preg_match("#([^a-zA-Z0-9_]+)#", $pseudo)) {
                $msg = "le Pseudo doit contenir uniquement des lettres(non accentuées), des chiffres et des __underscores__";
                $type = "alert-danger";
            } else {
                $pseudolength = mb_strlen($pseudo);
                if ($pseudolength <= 25) {
                    $verif = $db->prepare("SELECT * FROM membres WHERE pseudo = ?");
                    $verif->execute(array($pseudo));
                    $pseudoExist = $verif->rowCount();

                    if ($pseudoExist == 0) {
                        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                            $verif = $db->prepare("SELECT * FROM membres WHERE email = ?");
                            $verif->execute(array($email));
                            $emailExist = $verif->rowCount();

                            if ($emailExist == 0) {
                                if ($mdp == $mdp1) {
                                    $mdpt = mb_strlen($mdpt);
                                    if ($mdpt >= 8) {
                                        if (isset($_POST['condition'][1])) {
                                            $inscription = $db->prepare(
                                                "INSERT INTO membres(pseudo,nom_complet,email,mdp,avatar,statut,date_ins) VALUES(?,?,?,?,?,?,now())"
                                            );

                                            $inscription->execute(array($pseudo, $name, $email, $mdp, "ng.png", $statut));
                                            $_SESSION['msg'] = "Votre compte a bien été crée !";
                                            $_SESSION['type'] = "alert-success";
                                            header('location:pages/membres/login.php');
                                            exit();
                                        } else {
                                            $msg = "Vous devez accepter les " . "<a href='/privacy'>" . "Conditions d'utilisation" . "</a>";
                                            $type = "alert-danger";
                                        }
                                    } else {
                                        $msg = "Votre mot de passe doit faire au moins 8 caractères";
                                        $type = "alert alert-danger";
                                    }
                                } else {
                                    $msg = "Vos deux mot de passe ne correspondent pas";
                                    $type = "alert-danger";
                                }
                            } else {
                                $msg = "Cet adresse mail est dejà prise !";
                                $type = "alert-danger";
                            }
                        } else {
                            $msg = "Adresse mail non valide !";
                            $type = "alert-danger";
                        }
                    } else {
                        $msg = "Ce pseudo est dejà pris";
                        $type = "alert-danger";
                    }
                } else {
                    $msg = "Votre pseudo ne doit pas dépasser 25 caractères";
                    $type = "alert-danger";
                }
            }
        } else {
            $msg = "Complétez tous les champs";
            $type = "alert-danger";
        }
    }
}
