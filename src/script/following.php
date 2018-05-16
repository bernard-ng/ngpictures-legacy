<?php
session_start();
require "..helper/functions.php";
$db = base_connexion("ngbdd");

/*

heu petit de system de follow avec php... sa recharge tout la page j'ai besoin de l'ajax ici de facon a ce que
quand le user clique sur follow qu'on lui dise qu'il follow la personne et apr si il ya erreur qu'on lui dise,
bref le traitement doit s'effectuer de maniere Asynchrone...

pour follow il faut dabr qu'il ait une page precedant sur la quelle le user sera rediriger, puis il doit avoir
l'id de celui qu'il veux follow en method GET, puis on securise l'id recu en GET, puis on verifie si le user est bien
connecter ensuite on verifi si l'id en GET ne pas son id , puis on verifi si il follow deja cette personne si oui 'UNFOLLOW :)'
si non "FOLLOW " et dans dans le cas on l'inform de ce qui ce passer...

le code en bas est tres claire j'espere...

by BERNARD TSHABU NGANDU

*/

if(isset($_SERVER['HTTP_REFERER']) and !empty($_SERVER['HTTP_REFERER'])) {


    if(isset($_GET['followingID'])) {

        $getfollowedID= htmlspecialchars(intval($_GET['followingID']));
        if(isset($_SESSION['id']) and !empty($_SESSION["id"])) {

            if($getfollowedID != $_SESSION['id']) {
                $followed = $db ->prepare("SELECT * from following where followerID=? and followingID=?");
                $followed ->execute(array($_SESSION['id'],$getfollowedID));
                $followed = $followed->rowcount();

                if($followed == 0) {
                    $addFollowed= $db ->prepare("INSERT into following(followerID,followingID) value (?,?)");
                    $addFollowed->execute(array($_SESSION['id'],$getfollowedID));

                    $user= getUserPseudo($getfollowedID);
                    $_SESSION['msg'] = "vous suivez ".$user." !";
                    $_SESSION['type'] = "alert-info";

                }
                else if ($followed ==1) {
                    $delFollowed = $db ->prepare("delete from following where followerID=? and followingID=? ");
                    $delFollowed ->execute(array($_SESSION["id"],$getfollowedID));

                    $user= getUserPseudo($getfollowedID);
                    $_SESSION['msg'] = "vous ne suivez plus ". $user." !";
                    $_SESSION['type'] = "alert-info";
                }
            }

            header('location:'.$_SERVER['HTTP_REFERER']);

        }else{

            $_SESSION['msg'] = "vous devez vous connecté !";
            $_SESSION['type'] = "alert-danger";
            header('location:..pages/membres/login.php');
        }

    }else{  header('location:pages/plus/erreur/500.php');
    }

}else{  header('location:pages/plus/erreur/500.php');
}






    ?>
