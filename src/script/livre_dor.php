<?php
session_start();
require '..helper/functions.php';
$db = base_connexion("ngbdd");

if(isset($_SERVER['HTTP_REFERER']) and !empty($_SERVER['HTTP_REFERER'])) {
    if(isset($_SESSION['id']) and !empty($_SESSION['id'])) {
        if(isset($_POST['commenter'])) {
            if(!empty($_POST['commentaire'])) {

                $userID = htmlspecialchars($_SESSION['id']);
                $commentaire = htmlspecialchars($_POST['commentaire']);
                $insert = $db->prepare('INSERT into livre_dor(userID,commentaire,date_pub) values(?,?,now())');
                $insert->execute(array($userID,$commentaire));

                $_SESSION['msg'] = "Nous avons reçu votre commentaire";
                $_SESSION['type'] = "alert-success";
                header('location:'.$_SERVER['HTTP_REFERER']);

            }else{

                $_SESSION['msg'] = "complétez le champ";
                $_SESSION['type'] = "alert-danger";
                header('location:'.$_SERVER['HTTP_REFERER']);
            }
        }else{

            header('location:pages/plus/erreur/500.php');
        }
    }
    else{

        $_SESSION['msg'] = "vous devez vous connectez !";
        $_SESSION['type'] = "alert-danger";
        header('location:pages/membres/login.php');
    }
}else{

    header('location:pages/plus/erreur/500.php');
}


?>
