<?php
require(SRC . "/init.php");

if (isset($_SESSION['id']) and !empty($_SESSION['id'])) {

    $article = $db->query('SELECT * from article order by date_pub desc limit 0,5');
    $ngarticle = $db->query('SELECT * from ngarticle order by id desc  limit 0,5');

    if (isset($_GET['q']) and !empty($_GET['q'])) {
        $q = htmlspecialchars($_GET['q']);
        $article = $db->query('SELECT * from article where titre like "%' . $q . '%" order by date_pub desc');

        if ($article->rowcount() == 0) {
            $article = $db->query('SELECT * from article where concat(titre,contenu,id,date_pub) like "%' . $q . '%" order by id desc');
        }

        $ngarticle = $db->query('SELECT * from ngarticle where titre like "%' . $q . '%" order by date_pub desc');
        if ($article->rowcount() == 0) {
            $ngarticle = $db->query('SELECT * from ngarticle where concat(titre,contenu,id,date_pub) like "%' . $q . '%" order by id desc');
        }
    }

    if (isset($_GET['me']) and !empty($_GET['me'])) {

        $me = htmlspecialchars($_GET['me']);
        $article = $db->prepare('SELECT * from article where posterID = ? order by date_pub desc');
        $article->execute(array($me));
    }


} else {

    header("location:login.php");
    $_SESSION['msg'] = "vous devez vous connecter !";
    $_SESSION['type'] = "alert-danger";
}

?>
