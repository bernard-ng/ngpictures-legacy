<?php
require SRC . "/init.php";


if (isset($_SESSION['id']) and !empty($_SESSION['id'])) {

    $users = $db->prepare("SELECT * from membres where id != ? order by date_ins desc limit 0,20");
    $users->execute(array($_SESSION['id']));

    $follower = $db->prepare("SELECT followerID from following where followingID = ? order by id desc limit 0,20");
    $follower->execute(array($_SESSION['id']));

    $fn = $follower->rowcount();


    $following = $db->prepare("SELECT followingID from following where followerID = ? order by id desc limit 0,20");
    $following->execute(array($_SESSION['id']));


    if (isset($_GET['q']) and !empty($_GET['q'])) {
        $q = htmlspecialchars($_GET['q']);
        $users = $db->query("SELECT * from membres where pseudo like '%" . $q . "%' order by id desc");
    }

} else {

    header("location:pages/membres/login.php");
    $_SESSION['msg'] = "vous devez vous connecter !";
    $_SESSION['type'] = "alert-danger";
}
