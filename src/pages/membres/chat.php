<?php
session_start();
require '../src/helper/functions.php';
$db= base_connexion("ngbdd");
require_once "../src/script/cookie.php";

if(isset($_SESSION['id']) and !empty($_SESSION['id'])) {
    if(isset($_POST['message'])) {
        if(!empty($_POST['message'])) {
            if(preg_match("#^(.+)$#", $_POST['message'])) {

                        $message =htmlspecialchars($_POST['message']);
                        $insert = $db->prepare('INSERT into chat(message,userID,date_pub) values (?,?,NOW()) ');
                        $insert->execute(array($message,$_SESSION['id']));
            }
        }
    }

}else{

    $_SESSION['msg'] = "vous devez vous connecter !";
    $_SESSION['type'] = "alert-danger";
    header('location:pages/membres/login.php'); 
}

?>
<!doctype html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="fr">
<head>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width" />
    <?php require "../includes/favicon.php";?>
    <?php require '../includes/all-meta.php'; ?>
    <title>Chat général</title>

    <link rel="stylesheet" href="/assets/css/AdminLTE.min.css">
    <link href="/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" >
    <link href="/assets/css/ng.css" rel="stylesheet" type="text/css" >
    <link href="/assets/css/jquery.cssemoticons.css" rel="stylesheet" type="text/css" >

</head>
<body>

<div class="chatboxx">
    <div class="menu">

        <div class="back">
            <a href="profil.php?id=<?php echo $_SESSION['id']?>" class="ng-link-default">
                <span class="glyphicon glyphicon-chevron-left"></span>
            </a>
            <img src="pages/membres/Avatar/40-40/<?php echo getUserProfil($_SESSION['id'])?>" draggable="false"/>
        </div>
        <div class="name">Chat-Général</div>
        <?php echo check_online_number(); ?>

    </div>
</div>
<br><br><br>
<?php require '../includes/verset.php'; ?>
<?php require "../includes/flash.php";?>

<div class="col-lg-3 col-sm-3 c col-md-3  hidden-xs ">
<div class="row">
<?php require '../includes/last-ngpictures.php'; ?>
</div>
</div>

<div class="col-lg-6  col-sm-6  col-md-6  col-xs-12 ">
<div class="row">
<div class="chatboxx ng-panel-active">
    <ol class="chat">

        <?php $all = $db->query("SELECT * from chat order by date_pub ");
        while($msg = $all->fetch()) {?>

        <?php if($msg['userID'] != $_SESSION['id']) {?>

            <li class="other">
                <div class="avatar">
                    <a href="profil.php?id=<?php echo $msg['userID'] ?>">
                        <img src="pages/membres/Avatar/40-40/<?php echo getUserProfil($msg['userID']) ?>" draggable="false"/>
                    </a>
                </div>

                <div class="msg text" id="regular">
                    <p><?php echo text($msg['message'])?></p>
                    <time><?php echo getRelativeTime($msg['date_pub'])?></time>
                </div>
            </li>

        <?php }else if($msg['userID'] == $_SESSION['id']) {?>

                <li class="self">
                    <div class="msg text" id="regular">
                        <p><?php echo nl2br(user_mention_verif($msg['message']))?></p>
                        <time><?php echo getRelativeTime($msg['date_pub'])?></time>
                    </div>
                </li>

        <?php }

        } ?>

    </ol>
</div>
</div>
</div>

<div class="">
<div class="row">

<div class="ng-panel panel panel-default">
    <div class="box-header with-border">
        <h4 class="box-title"><span class="glyphicon glyphicon-chevron-right"></span> En ligne</h4>
    </div>
    <div class="box-body no-padding">
        <ul class="users-list clearfix">
            <?php $online = $db->query("SELECT userID from online limit 0,8");
            while ($m1 =  $online->fetch()){ ?>

            <li>
                <img src="membres/Avatar/90-90/<?php echo getUserProfil($m1['userID']) ?>" width="90" height="90">
                <a class="users-list-name" href="pages/membres/profil.php?id=<?php echo $m1['userID'] ?>">
                <?php echo getUserPseudo($m1['userID'])?></a>
            </li>

            <?php }?>
        </ul>
    </div>
</div>

</div>
</div>

<form  action="" method="POST">
    <div class="textarea">
        <textarea name="message" placeholder="Message..."/></textarea>
        <button class="textarea btn btn-primary" type="submit" name="message1" >
            <span class="glyphicon glyphicon-send"></span>
        </button>
    </div>
</form>

<!-- script -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script>
    window.jQuery || document.write('<script src="../assets/js/js+/jquery.min.js"><\/script>')
    </script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/ng-alert-V2.js"></script>

<!-- / script -->

</body>
</html>
