<?php
require SRC . "/init.php";

if (isset($_SESSION['id']) and !empty($_SESSION['id'])) {
    if (isset($_GET['id']) and !empty($_GET['id'])) {
        $getID = intval($_GET['id']);
        $verif = $db->prepare("SELECT * FROM membres where id=?");
        $verif->execute(array($getID));

        if ($verif->rowcount() == 1) {
            $userInfo = $verif->fetch();
            $news = $db->query("SELECT * FROM article where posterID =" . $userInfo['id'] . " order by date_pub desc");
            $a = $news->fetch();
            $articleID = $a['id'];

        } else if (isset($_GET['id']) and $_GET['id'] = 0 xor empty($_GET['id'])) {

            header('location:profil.php?id=' . $_SESSION['id']);
            $_SESSION['msg'] = "Utilisateur non trouvé !";
            $_SESSION['type'] = "alert-warning";
        }

    } else {
        header("location:pages/membres/profil.php?id=" . $_SESSION['id']);
    }

} else {
    header("location:pages/membres/login.php");
    $_SESSION['msg'] = "vous devez vous connecter !";
    $_SESSION['type'] = "alert-danger";
}


?>
