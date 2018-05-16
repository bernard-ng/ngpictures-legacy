<?php
session_start();
require "../src/helper/functions.php";
$db = base_connexion("ngbdd");
include_once("../src/script/cookie.php");
include '../src/script/online.php';

if(isset($_SESSION['id']) and !empty($_SESSION['id']))
{
/*

    pour afficher les news seulement pour mes amis mais j'y arrive pas...


    $user = $db->prepare("SELECT followingID from following where  followerID= ? order by id desc");
    $user->execute(array($_SESSION['id']));
    $exist = $user->rowcount();
    $me = array($_SESSION['id']);

    while($u = $user->fetch()){

            $list = $u['followingID']."\n" ;
    }

    $user_list = explode(" ",$list);
    print_r($user_list);


*/
}else{

    header("location:pages/membres/login.php");
    $_SESSION['msg'] = "vous devez vous connecter!";
    $_SESSION['type'] = "alert alert-danger"; }
?>
<!doctype html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="fr">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width" />
    <?php include "../includes/favicon.php";?>
    <?php include '../includes/all-meta.php'; ?>
    <title>Actualités</title>

    <link rel="stylesheet" href="/assets/css/AdminLTE.min.css">
    <link href="/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" >
    <link href="/assets/css/ng.css" rel="stylesheet" type="text/css" >

</head>
<body>
<?php include "../includespages/article/menu.php"; ?>
<?php include "../includes/flash.php"; ?>


<div class="jumbotron ng-margin-default">
    <div class="media">
        <div class="container">
            <div class="media-body" >
                <h2 class="media-heading" style="color:#428bca;"><span class="glyphicon glyphicon-globe" aria-hidden="true"></span> Actualités</h2>
                Salut <b><?= getUserPseudo($_SESSION['id']) ?></b>, ici tu rétrouveras les articles de tes amis, tu rétrouveras aussi leur photos, fait une recherche pour plus de résultats...
            </div>
        </div>
    </div>
</div>
<section class="ng-bloc-principal container">
<!-- verset -->
    <?php include '../includes/verset.php'; ?>
<!-- verset -->
<!-- bar de recherche et carousel de contact -->
    <div class="col-lg-3 col-md-3 col-xs-12 col-sm-3">
        <div class="row">
            <div class="container-fluide">
                <form class="input-group ng-panel-info " method="get" action="pages/membres/recherche.php">
                    <input name="q" type="text" class="form-control" placeholder="Recherche...">
                        <span class="input-group-btn" >
                            <button  type="submit" value="Go" class="btn btn-primary ng-input" type="button">
                                    <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
                            </button>
                        </span>
                </form>
                <?php include '../includes/contact-carousel.php'; ?>
            </div>
        </div>
    </div>
<!-- /bar et carousel-->
</div>

<div class="col-lg-6 col-sm-6 col-xs-12">
    <div class="row">

    <?php
        $verif=$db->query("SELECT * from article order by date_pub desc ");
        $verif = $verif->rowcount();
        if($verif == 0 ){
    ?>

    <div class="ng-panel panel panel-default ng-panel-active">
        <div class="ng-panel panel-heading ng-margin-default">
            <span class="glyphicon glyphicon-alert pull-right"></span>  AUCUNE PUBLICATION POUR L'INSTANT
        </div>
        <ul class="list-group">
            <li class="list-group-item ng-panel-img">
                <div class="container-fluide">
                    <img src="pages/article/miniature/rien.jpg" class="img-responsive" width="640" height="640">
                </div>
            </li>
        </ul>
    </div>

    <?php }else{?>

    <!-- resultat -->
        <?php
            $news=$db->query("SELECT * from article order by date_pub desc ");
            while($a= $news->fetch()){
        ?>

            <div class="ng-panel panel panel-default ng-panel-active">
                <div class="ng-panel panel-heading ng-margin-default ng-padding-default">
                    <img src="pages/membres/Avatar/40-40/<?= getUserProfil($a['posterID']) ?>" width="40" height="40" class="img img-circle"/>&nbsp;
                            <a class="ng-user-name" href="pages/membres/profil.php?id=<?= $a['posterID']?>">
                                <?= getUserPseudo($a['posterID']);?>
                            </a>
                            <span class="pull-right ng-time">
                                <time><span class="glyphicon glyphicon-time"></span> <?= getRelativeTime($a['date_pub'])?></time>
                            </span>
                </div>
                <ul class="list-group">
                    <li class="list-group-item ng-panel-img">
                        <div class="container-fluide">
                            <a href="article.php?id=<?=$a['id']?>"/>
                            <center>
                                <img src="pages/article/miniature/640-640/<?= getPostThumb($a['id'])?>"  alt="" class="img-responsive" >
                            </center>
                            </a>
                        </div>
                    </li>
                </ul>

                <div class="panel-body">
                    <h4><strong><?= $a['titre'] ?></strong></h4>
                    <p><?php echo nl2br(user_mention_verif(truncate($a['contenu']))); ?></p>
                </div>

                <?php if(($_SESSION['id']) != ($a['posterID'])){?>

                    <li class="list-group-item ng-margin-default">
                        <a class="btn btn-primary btn-xs ng-btn" href="/src/script/like.php?t=1&id=<?= $a['id']?>" role="button"><span class="glyphicon glyphicon-thumbs-up"></span></a>
                        <?= check_like_statut($a['id'],$_SESSION['id']) ?> <?= KMF(getArticleInfo($a['id'],"like")) ?>
                    </li>

                <?php }else{?>

                    <li class="list-group-item ng-margin-default">

                        <a class="btn btn-primary btn-xs ng-btn"  href="/envoie-photo?edit=<?=$a['id']?>"><span class="glyphicon glyphicon-edit"></span></a>

                        <a class="btn btn-primary btn-xs ng-btn" href="/src/script/like.php?t=1&id=<?= $a['id']?>" role="button"><span class="glyphicon glyphicon-thumbs-up"></span></a>
                        <?= check_like_statut($a['id'],$_SESSION['id']) ?> <?= KMF(getArticleInfo($a['id'],"like")) ?>

                    </li>

                <?php }?>
            </div><!-- / panel-default -->
        <?php }?>
        <?php }?>
    <!-- fin resultat-->

    </div>
</div>

<div class="col-sm-3 col-md-3 col-xs-12 col-lg-3">
    <div class="row">
    <!-- service -->
            <nav>
                <div class="ng-panel panel-primary panel-heading">
                    <span class="left">NAVIGATION RAPIDE</span><br>

                    <a class="btn btn-primary btn-xs ng-btn" href="/index.php" >
                        <span class="glyphicon glyphicon-home" aria-hidden="true"></span></a>

                    <a class="btn btn-primary btn-xs ng-btn" href="/actualite" >
                        <span class="glyphicon glyphicon-globe" aria-hidden="true"></span></a>

                    <a class="btn btn-primary btn-xs ng-btn" href="/profil?id=<?= $_SESSION['id']?>" >
                        <span class="glyphicon glyphicon-user" aria-hidden="true"></span></a>

                    <a class="btn btn-primary btn-xs ng-btn" href="/envoie-photo" >
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>

                    <a class="btn btn-primary btn-xs ng-btn" href="/galerie?id=<? $_SESSION['id']?>">
                        <span class="glyphicon glyphicon-picture" aria-hidden="true"></span></a>
                </div>
            </nav>
    <!-- /service -->

        <div class="hidden-xs">
        <!-- verset biblique du jour -->
                    <div class="ng-alert ng-panel panel panel-primary ">
                          <div class="ng-panel panel-heading " role="tab" id="headingOne1">

                                <a role="button" data-toggle="collapse" data-parent="#accordion1" href="#collapseOne1" aria-expanded="true" aria-controls="collapseOne1"><span class="glyphicon glyphicon-book"></span>
                                GOD FRIST
                                </a>

                          </div>
                          <div id="collapseOne1" class="panel-collapse collapse in" role="tabpanel" aria-labelle$dby="headingOne1">
                                <div class="panel-body">
                                            <?= getTodayVerset() ?>
                                            <br><br>
                                            <b style="color:#000"><?= getTodayVersetRef()?></b>
                                </div>
                          </div>
                    </div>
        <!-- /verset biblique du jour -->
        </div>
    </div>
</div>

<div class="ng-espace-fantom"></div>
</section>
<?php include "../includes/footer.php"; ?>

<!--importation des script -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script>
    window.jQuery || document.write('<script src="/assets/js/js+/jquery.min.js"><\/script>')
    </script>
    <script src="/assets/js/bootstrap.min.js"></script>
    <script src="/assets/js/ng-alert-V2.js"></script>
<!-- /importation des script -->

</body>
</html>
