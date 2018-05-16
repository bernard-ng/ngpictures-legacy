<?php
session_start();
require '../src/helper/functions.php';
$db = base_connexion("ngbdd");
include '../src/script/cookie.php';
include '../src/script/online.php';


if (isset($_SESSION['id']) and !empty($_SESSION['id']))
{

        $article = $db ->query("SELECT id  from article order by date_pub desc");

        if(isset($_GET['id']) and $_GET['id'] > 0 )
        {
            $getID=intval($_GET['id']);
            $verif=$db->prepare("SELECT * from membres where id=?");
            $verif->execute(array($getID));


            if(isset($_GET['q']) and !empty($_GET['q'])){

                $q = htmlspecialchars($_GET['q']);
                $userInfo=$verif->fetch();
                $photo = $db->prepare("SELECT * from galerie  where userID= ? and concat(tags,userID,date_pub) like '%".$q."%' order by date_pub desc ");
                $photo->execute(array($userInfo['id']));
                $Nump = $photo->rowcount();

            }
            if($verif->rowcount() == 1)
            {

                $userInfo=$verif->fetch();
                $photo = $db->prepare("SELECT * from galerie  where userID= ? order by date_pub desc ");
                $photo->execute(array($userInfo['id']));
                $Nump = $photo->rowcount();
            }


        }else{

                if(isset($_GET['q']) and !empty($_GET['q'])){


                    $q = htmlspecialchars($_GET['q']);
                    $photo = $db->query("SELECT * from nggalerie  where concat(tags,userID,date_pub) like '%".$q."%' order by date_pub desc ");
                    $Nump = $photo->rowcount();

                }else{

                    $photo = $db->query("SELECT * from nggalerie  order by  date_pub  desc ");
                    $Nump = $photo->rowcount();
                }

            }

    if(isset($_POST['portrait'])){

        $class = "col-lg-12 col-xs-12 col-sm-12 col-md-12";

    }else{

        $class = "col-lg-2 col-sm-3 col-md-2 col-xs-3";
    }

}
else{
  header("location:..pages/membres/login.php");
  $_SESSION['msg'] = "vous devez vous connecter!";
  $_SESSION['type'] = "alert-danger";
}
?>

<!doctype html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width" />
    <?php include "../includes/favicon.php";?>
    <?php include '../includes/all-meta.php'; ?>
    <title>Galerie</title>

    <link rel="stylesheet" href="/assets/css/AdminLTE.min.css">
    <link href="/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" >
    <link href="/assets/css/ng.css" rel="stylesheet" type="text/css" >

</head>
<body>
<section class="ng-bloc-principal">

<?php include '../includespages/galerie/menu.php'; ?>
<?php include '../includes/flash.php'; ?>



<div class="jumbotron ng-margin-default">
    <div class="media">
        <div class="container">
            <div class="media-body" >
                <h2 class="media-heading" style="color:#428bca;"><span class="glyphicon glyphicon-picture" aria-hidden="true"></span> Galerie</h2>
                hey <b><?= $_SESSION['pseudo']?></b>, Bienvenue dans ma galerie
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="col-xs-12">
    <div class="row">
        <ul class="nav nav-tabs ng-margin-default">
            <li role="presentation">
                <?php if(isset($_GET['id']) and !empty($_GET['id'])){?>
                    <a  href="/galerie" >
                        <span class="glyphicon glyphicon-picture" aria-hidden="true"></span> Galerie
                    </a>
                <?php }else{ ?>
                    <a  href="/galerie?id=<?=$_SESSION['id']?>" >
                        <span class="glyphicon glyphicon-picture" aria-hidden="true"></span> Ma galerie
                    </a>
                <?php } ?>
            </li>
        </ul>
    </div>
</div>

<div class="col-lg-3 col-md-3 hidden-xs col-sm-3">
      <div class="row">
            <div class="container-fluide">
                <form class="input-group ng-panel-info " method="GET" action="galerie.php">
                    <input name="q" type="text" class="form-control" placeholder="Rechercher une photo...">
                    <span class="input-group-btn" >
                        <button  type="submit" value="Go" class="btn btn-primary ng-input" type="button">
                            <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
                        </button>
                    </span>
                </form>

<!-- carousel -->
                <div class="ng-alert ng-panel panel panel-primary">
                    <div class="ng-panel panel-heading " role="tab" id="headingOne1"><span class="glyphicon glyphicon-camera"></span>  #NGPICTURES
                    </div>

                <div class="panel-body">
                    <p>
                        Hey <b><?= getUserPseudo($_SESSION['id'])?></b> Tu peux Rétrouver ces articles Tout de suite...<br> en un clique
                    </p>
                </div>

                <ul class="list-group">
                    <li class="list-group-item ng-panel-img">
                        <div id="myCarousel" class="carousel" data-ride="carousel">
                            <div class="carousel-inner" role="listbox">
                                <div class="item active">
                                    <img class="img img-responsive" src="pages/article/miniature/640-640/rien.jpg"/>
                                </div>

                                <?php while($a = $article->fetch()){?>

                                    <div class="item">
                                        <a href="pages/articlepages/article.php?id=<?= $a['id'] ?>"/>
                                            <img class="img img-responsive" src="..pages/article/miniature/640-640/<?= getPostThumb($a['id']); ?>"/>
                                        </a>
                                    </div>

                                <?php } ?>
                            </div>
                        </div>
                    </li>
                </ul>
<!-- /carousel -->
    </div>
</div>
<div class="show-xs">
<div class="ng-panel ng-alert panel panel-primary">
    <div class="ng-panel ng-margin-default panel-heading">
        <span class="glyphicon glyphicon-chevron-right"></span> AFFICHAGE DES PHOTOS
    </div>

    <form action="" method="POST">
        <ul class="list-group">
            <li class="list-group-item">
                <span class="glyphicon glyphicon-list"></span>  Liste
                <div class="material-switch pull-right">
                    <input id="someSwitchOptionPrimary" name="portrait" type="checkbox" />
                    <label for="someSwitchOptionPrimary" class="label-primary"></label>
                </div>
            </li>
            <li class="list-group-item">
                <span class="glyphicon glyphicon-list"></span>  Gride
                <div class="material-switch pull-right">
                    <input id="someSwitchOptionPrimary1" name="normal" type="checkbox"/>
                    <label for="someSwitchOptionPrimary1" class="label-primary"></label>
                </div>
            </li>
            <li class="list-group-item">
            <button type="submit" class="btn btn-primary btn-sm">changer</button>
            <button type="reset" class="btn btn-primary btn-sm">Annuler</button>
        </li>
        </ul>

    </form>

</div>

</div>
</div><!-- important -->
</div><!-- important -->


<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12" >
    <div class="row">
        <div class="ng-panel panel panel-default ng-panel-active">
        <div class="ng-panel panel-heading ng-margin-default"><span class="glyphicon glyphicon-camera pull-right"></span> DEEP SHOOTING...</div>

        <?php if($Nump == 0) {?>

            <div class="ng-panel panel-heading ng-margin-default"><span class="glyphicon glyphicon-alert pull-right"></span> AUCUNE PUBLICATION POUR L'INSTANT</div>
                <ul class="list-group">
                    <li class="list-group-item ng-panel-img">
                        <div class="container-fluide">
                            <a><img src="pages/article/miniature/rien.jpg" class="img-responsive" ></a>
                        </div>
                    </li>
                </ul>

        <?php }else{

            if(isset($_GET['id']) and !empty($_GET['id'])){
            while($p = $photo->fetch()){?>

                <div class= "<?= $class ?>">
                    <div class="row">
                        <div class="ng-img">
                            <a href="pages/galerie/photo.php?type=user&id=<?= $p['id']; ?>">
                                <img class="img text-right" width="100%" src="pages/galerie/images/640-640/<?= getPicturesThumb($p['id']); ?>"/>
                            </a>
                        </div>
                    </div>
                </div>

        <?php  }

            }else{
            while($p = $photo->fetch()){?>

                <div class= "<?= $class ?>">
                    <div class="row">
                        <div class="ng-img">
                             <a href="pages/galerie/ngphoto.php?id=<?= $p['id']; ?>">
                                <img class="img text-right" width="100%" src="pages/galerie/ngimages/640-640/<?= getBlogPicturesThumb($p['id']); ?>"/>
                            </a>
                        </div>
                    </div>
                </div>

           <?php } // while
            } // else
        }  // else principal
        ?>
        </div>
    </div>
    <div class="ng-espace-fantom"></div>
</div>

<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
<div class="row">
    <div class="ng-panel panel-primary panel-heading ">
        <span class="left">NAVIGATION</span><br>

        <a class="btn btn-primary btn-xs ng-btn" href="/index.php" >
              <span class="glyphicon glyphicon-home" aria-hidden="true"></span>
        </a>
        <a class="btn btn-primary btn-xs ng-btn" href="/actualite" >
              <span class="glyphicon glyphicon-globe" aria-hidden="true"></span>
        </a>

        <a class="btn btn-primary btn-xs ng-btn" href="/profil?id=<?= $_SESSION['id']?>" >
              <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
        </a>

        <a class="btn btn-primary btn-xs ng-btn" href="/envoie-photo" >
              <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
        </a>

        <a class="btn btn-primary btn-xs ng-btn" href="/galerie">
              <span class="glyphicon glyphicon-picture" aria-hidden="true"></span>
        </a>
    </div>

 <div class="hidden-xs">
<?php include '../includes/last-ngpictures.php'; ?>
</div>

</div>

</div>


</div>
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
