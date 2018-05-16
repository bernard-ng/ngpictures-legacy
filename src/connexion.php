<?php
require SRC."/init.php";

if (isset($_POST['connexion'])) {
    $pseudoconnect = htmlspecialchars($_POST['pseudoconnect']);
    $mdpconnect = sha1($_POST['mdpconnect']);

    if (!empty($pseudoconnect) and !empty($mdpconnect)) {
        $verif = $db->prepare("SELECT * FROM membres WHERE pseudo = ? AND mdp = ? ");
        $verif->execute(array($pseudoconnect, $mdpconnect));
        $userExist = $verif->rowCount();

        if ($userExist == 1) {
            if (isset($_POST['stay_online'][1])) {
                setcookie("pseudo", $pseudoconnect, time() * 365 * 24 * 3600, null, null, false, true);
                setcookie("mdp", $mdpconnect, time() * 365 * 24 * 3600, null, null, false, true);
            }

            $userInfo = $verif->fetch();
            $_SESSION['id'] = $userInfo['id'];
            $_SESSION['pseudo'] = $userInfo['pseudo'];

            $_SESSION['msg'] = "Connecté !";
            $_SESSION['type'] = "alert-success";
            header("location:pages/membres/Profil.php?id=" . $_SESSION['id']);
            exit();
        } else {
            $msg = "Mauvais Pseudo ou mot de passe";
            $type = "alert-danger";
        }
    } else {
        $msg = "complétez tous les champs";
        $type = "alert-danger";
    }
}
?>
