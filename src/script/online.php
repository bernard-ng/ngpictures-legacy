<?php

if (isset($_SESSION['id']) && !empty($_SESSION['id'])) {
    $time_actu = time();
    $userID = $_SESSION['id'];
    $verif = $db->prepare('SELECT * from online where userID = ?');
    $verif->execute(array($userID));
    $user_online = $verif->rowcount();

    if ($user_online == 0) {
        $ins = $db->prepare("INSERT into online(time_actu,userID) values(?,?) ");
        $ins->execute(array($time_actu, $userID));
    } else {
        $update = $db->prepare("UPDATE online set time_actu = ?  where userID = ?");
        $update->execute(array($time_actu, $userID));
    }

    $online_session = time() - 20;
    $del = $db->prepare("DELETE from online where time_actu < ?");
    $del->execute(array($online_session));
    $online_users = $db->query("SELECT * from online");
    $nb_online = $online_users->rowcount();
}
