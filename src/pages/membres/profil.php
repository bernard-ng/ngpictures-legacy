<?php require("src/profile.php"); ?>
<!doctype html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="fr">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width" />
    <?php include "../includes/favicon.php";?>
    <?php include '../includes/all-meta.php'; ?>

        <title>
            <?= getUserPseudo($userInfo['id']) ?>
        </title>

        <link rel="stylesheet" href="/assets/css/AdminLTE.min.css">
        <link href="/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" >
        <link href="/assets/css/ng.css" rel="stylesheet" type="text/css" >
</head>
<body>
    <?php include "../includes/profil/menu.php"; ?>
    <?php include "../includes/flash.php";?>
    <!-- profil proprement dit -->
    <div class="twpc-div">
        <div class="twpc-bg twpc-block1" style="background-image: url('/assets/imgs/photong.jpg');"></div>
            <div>
                <div class="twpc-button">

                    <?php if (isset($getID) and $_SESSION['id'] != $getID) { ?>

                        <a href="/src/script/following.php?followingID=<?= $getID ?>"><button class="btn btn-primary btn-xs"><?= check_following_statut($_SESSION['id'], $getID); ?></button></a>
                        <a href="/galerie?id=<?= $userInfo['id'] ?>"><button class="btn btn-primary btn-xs">Galerie</button></a>

                    <?php
                } else { ?>

                        <a href="pages/membres/users.php"><button class="btn btn-primary btn-xs">Membres</button></a>
                        <a href="pages/membres/chat.php"><button class="btn btn-primary btn-xs">Chat-G</button></a>
                        <a href="/galerie?id=<?= $userInfo['id'] ?>"><button class="btn btn-primary btn-xs">Galerie</button></a>

                    <?php
                } ?>

                </div>

                <a class="twpc-avatarlink">
                <img class="twpc-avatarimg" src="pages/membres/Avatar/90-90/<?= getUserProfil($userInfo['id']) ?>" width="90" height="90" />
                </a>

                <div class="twpc-divuser">
                    <div class="twpc-divname">
                        <?= ucfirst(getUserName($userInfo['id'])) ?>
                    </div>
                    <div class="twpc-divname">
                        <?= getUserPseudo($userInfo['id']) ?>
                    </div>
                </div>

                <div class="nav-tabs">
                    <div class="twpc-divstats">
                        <ul class="twpc-arrange">
                            <li class="twpc-arrangesizefit">
                                <a>
                                    <span class="twpc-statlabel twpc-block">Following</span>
                                    <span class="twpc-statvalue">
                                    <?= KMF(Check_following_num($userInfo['id'])) ?></span>
                                </a>
                            </li>

                            <li class="twpc-arrangesizefit">
                                <a>
                                    <span class="twpc-statlabel twpc-block">Follower<?= $test = (Check_follower_num($userInfo['id']) > 1) ? "s" : ""; ?> </span>
                                    <span class="twpc-statvalue">
                                    <?= KMF(Check_follower_num($userInfo['id'])) ?></span>
                                </a>
                            </li>

                            <li class="twpc-arrangesizefit">
                                <a>
                                    <span class="twpc-statlabel twpc-block">
                                    <?php $poste = getPicturesInfo($userInfo['id'], "nombre") + getArticleInfo($userInfo['id'], "nombre") ?>

                                    Poste<?= $test = ($poste > 1) ? "s" : ""; ?> </span>
                                    <span class="twpc-statvalue">
                                    <?= KMF($poste) ?></span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
    </div>
<!-- fin -->
<section class="ng-bloc-principal container">
<?php include '../includes/profil/verset.php'; ?>

<!-- statut et information -->
<div class="col-xs-12 col-lg-3 col-sm-3  col-md-3">
    <div class="row">
        <form class="input-group ng-panel-info" method="GET" action="pages/membres/recherche.php">
            <input name="q" type="text" class="form-control" placeholder="Recherche...">
            <span class="input-group-btn" >
            <button  type="submit" class="btn btn-primary ng-input" type="button"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
            </span>
        </form>

        <div class="ng-alert ng-panel panel panel-primary">
            <div class=" ng-panel panel-heading nav-fixed-top"><span class="glyphicon glyphicon-chevron-right"></span>  STATUT ET INFOS
            </div>
            <div class="panel-body">
                <p>
                    <?php

                        if(empty($userInfo['statut'])){echo " hey tout le monde suis sur #Ngpictures";}
                        else{ echo text($userInfo['statut']);}

                    ?>
                </p>
            </div>

            <ul class="list-group">
                <li class="list-group-item wow fadeInRight"><span class="glyphicon glyphicon-pencil"></span>
                    <a href="pages/membres/recherche.php?me=<?= $userInfo['id']?>">Articles</a><span class="badge ng-badge">
                        <?= KMF(getArticleInfo($userInfo['id'],"nombre")) ?>
                    </span>

                </li>

                <li class="list-group-item wow fadeInRight">
                    <span class="glyphicon glyphicon-camera"></span>
                        <a href="/galerie?id=<?= $userInfo['id'] ?>">photos</a><span class="badge ng-badge">
                        <?= KMF(getPicturesInfo($userInfo['id'],"nombre")) ?>
                    </span>
                </li>

                <?php if($_SESSION['id'] == $userInfo['id']){?>

                    <li class="list-group-item">
                        <span class="glyphicon glyphicon-user"></span>
                            <a href="pages/membres/editProfil.php?id=<?= $_SESSION['id']?>">Editer mon profil</a>
                        <span class="badge ng-badge"></span>
                    </li>

                <?php }?>

            </ul>
        </div>
    </div>
</div>
<!-- / statut et information -->


<div class="col-xs-12 col-md-6 col-sm-6 col-lg-6">
    <div class="row">
        <?php $verif=$db->query("SELECT * FROM article where posterID =".$userInfo['id']." order by date_pub desc ");
        $verif = $verif->rowcount();
        if($verif == 0 ){?>

        <div class="ng-panel panel panel-default ng-panel-active">
            <div class="ng-panel panel-heading ng-margin-default">
                <span class="glyphicon glyphicon-alert pull-right"></span>AUCUN ARTICLE POUR L'INSTANT
            </div>

            <ul class="list-group">
                <li class="list-group-item ng-panel-img">
                    <div class="container-fluide">
                        <a><img src="pages/article/miniature/rien.jpg" class="img-responsive" ></a>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>

<?php }else{?>

<?php include "../includes/profil/profil-modal.php"; ?>

<!-- affichage article -->
    <?php
        $news=$db->query("SELECT * FROM article where posterID =".$userInfo['id']." order by date_pub desc ");
        while($a= $news->fetch()) {
    ?>

    <div class="ng-panel panel panel-default ng-panel-active">
        <div class="ng-panel panel-heading ng-margin-default ng-padding-default">

            <img src="pages/membres/Avatar/40-40/<?= getUserProfil($userInfo['id']) ?>" width="40" height="40" class="img img-circle"/>&nbsp;

            <a class="ng-user-name" href="pages/membres/profil.php?id=<?= $userInfo['id']?>">
                <?= getUserPseudo($userInfo['id']);?>
            </a>

            <span class="pull-right ng-time">
                <time><span class="glyphicon glyphicon-time"></span> <?= getRelativeTime($a['date_pub'])?></time>
                <a data-toggle="modal" data-target=".pp">
                    <span class="glyphicon glyphicon-option-vertical"></span>
                </a>
            </span>

        </div>

        <ul class="list-group">
            <li class="list-group-item ng-panel-img">
                <div class="container-fluide">
                    <a href="pages/articlepages/article.php?id=<?=$a['id']?>"/>
                        <center>
                        <img src="pages/article/miniature/640-640/<?= getPostThumb($a["id"])?>" class="img-responsive" >
                        </center>
                    </a>
                </div>
            </li>
        </ul>

        <div class="panel-body">
            <h4><strong><?= $a['titre'] ?></strong></h4>
            <p><?php echo nl2br(user_mention_verif(truncate($a['contenu']))); ?></p>
        </div>

        <?php if(($_SESSION['id']) != ($userInfo['id'])){?>

            <li class="list-group-item ng-margin-default">

                <a class="btn btn-primary btn-xs ng-btn" href="/src/script/like.php?t=1&id=<?= $a['id']?>" role="button"><span class="glyphicon glyphicon-thumbs-up"></span></a>
                <?= check_like_statut($a['id'],$_SESSION['id']) ?> <?= KMF(getArticleInfo($a['id'],"like")) ?>

            </li>

        <?php }else{?>

            <li class="list-group-item ng-margin-default">
                <div class="collapse" id="art-<?=$a['id']?>">
                    <div class="well ng-well">
                        Voulez-vous vraiment supprimer " <b style="color:#000;"><?= $a['titre']?></b> " ?
                    <br>
                    <a type="button" href="/src/script/delete.php?id=<?=$a['id']?>" class="btn btn-default btn-xs"  role="button">Oui</a>

                    <a type="button" data-toggle="collapse" data-target="#art-<?=$a['id']?>" class="btn btn-default btn-xs"  role="button">Non</a>
                    </div>
                </div>

                <a class="btn  btn-primary btn-xs ng-btn" data-toggle="collapse" data-target="#art-<?=$a['id']?>" aria-expanded="false" aria-controls="delete-art"><span class="glyphicon glyphicon-remove-sign"></span></a>

                <a class="btn btn-primary btn-xs ng-btn"  href="/envoie-photo?edit=<?=$a['id']?>"><span class="glyphicon glyphicon-edit"></span></a>

                <a class="btn btn-primary btn-xs ng-btn" href="/src/script/like.php?t=1&id=<?= $a['id']?>" role="button"><span class="glyphicon glyphicon-thumbs-up"></span></a>
                <?= check_like_statut($a['id'],$_SESSION['id']) ?> <?= KMF(getArticleInfo($a['id'],"like")) ?>

            </li>

        <?php }?>
</div><!-- tres important -->
<?php } ?>

<!-- / affichage articles-->


</div>
</div>
</div>

<?php } // fin du else ?>


<!-- service et ngpictures -->

    <div class="col-md-3 col-sm-3 col-xs-12 col-lg-3">
        <div class="row">
            <div class="ng-panel panel-primary panel-heading">
                <!-- NAV RAPIDE -->
                    <nav>
                        <span class="left">NAVIGATION RAPIDE</span><br>

                        <a class="btn btn-primary btn-xs ng-btn" href="/index.php" >
                            <span class="glyphicon glyphicon-home" aria-hidden="true"></span></a>

                        <a class="btn btn-primary btn-xs ng-btn" href="/actualite" >
                            <span class="glyphicon glyphicon-globe" aria-hidden="true"></span></a>

                        <a class="btn btn-primary btn-xs ng-btn" href="pages/membres/editProfil.php?id=<?= $_SESSION['id']?>" >
                            <span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a>

                        <a class="btn btn-primary btn-xs ng-btn" href="pages/membres/chat.php" >
                            <span class="glyphicon glyphicon-comment" aria-hidden="true"></span></a>

                        <a class="btn btn-primary btn-xs ng-btn" href="/galerie?id=<?= $_SESSION['id']?>">
                            <span class="glyphicon glyphicon-picture" aria-hidden="true"></span></a>
                    </nav>
                <!-- /NAV RAPIDE -->
            </div>
            <?php include '../includes/last-ngpictures.php'; ?>
        </div>
    </div>
<!-- /service et ngpictures -->

<div class="ng-espace-fantom"></div>
</section>

<?php include "../includes/footer.php"; ?>


<!-- script -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script>
    window.jQuery || document.write('<script src="/assets/js/js+/jquery.min.js"><\/script>')
    </script>
    <script src="/assets/js/bootstrap.min.js"></script>
    <script src="/assets/js/ng-alert-V2.js"></script>
<!-- / script -->

</body>
</html>
