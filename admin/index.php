<?php
session_start();
require "../src/helper/functions.php";
$db= base_connexion("ngbdd");
require "script/traitement.php";

?>
<!DOCTYPE html>
<html>
<head>

    <?php include '../includes/favicon.php';?>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width" />

    <title>Administration</title>
    <link rel="stylesheet" href="/assets/css/AdminLTE.min.css">
    <link href="/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" >
    <link href="/assets/css/ng.css" rel="stylesheet" type="text/css" >

</head>


<body>
<section class="ng-bloc-principal">

<?php include "../includes/admin/menu.php"; ?>
<?php include "../includes/flash.php";?>



<div class="jumbotron">
    <div class="container">
    <h2><span class="glyphicon glyphicon-dashbord"></span> Tableau de bord <small>v1.0</small></h2>
    ma page d'administration...
    </div>
</div>


<section class="content">

<div class="row">

    <div class="col-md-4 col-sm-6 col-xs-12">
        <div class="info-box ng-panel-active">
            <a href="/admin/gestion/gestion-membres.php">
                <span  class="info-box-icon bg-primary info-box-icon"><span class="glyphicon glyphicon-user"></span></span>
                <div class="info-box-content">
                    <span class="info-box-text">Membres</span>
                    <span class="info-box-number"><?= KMF($Nb_membres)?></span>
                </div>
            </a>
        </div>
    </div>

    <div class="col-md-4 col-sm-6 col-xs-12">
        <div class="info-box ng-panel-active">
            <a href="/admin/gestion/gestion-articles.php">
                <span class="info-box-icon bg-primary"><span class="glyphicon glyphicon-pencil"></span></span>
                <div class="info-box-content">
                    <span class="info-box-text">Articles</span>
                    <span class="info-box-number"><?= KMF($Nb_article)?></span>
                </div>
            </a>
        </div>
    </div>

    <div class="col-md-4 col-sm-12 col-xs-12">
        <div class="info-box ng-panel-active">
            <a href="/admin/gestion/gestion-photos.php">
                <span class="info-box-icon bg-primary"><span  class="glyphicon glyphicon-picture"></span></span>
                <div class="info-box-content">
                    <span class="info-box-text">photos</span>
                    <span class="info-box-number"><?= KMF($Nb_photo)?></span>
                </div>
            </a>
        </div>
    </div>
</div><!-- row -->


<div class="row"><!-- principal row -->
<div class="col-md-12">

    <ul class="nav nav-tabs" id="myTabs" role="tablist">
        <li role="presentation" class="active">
            <a href="#article" id="article-tab" role="tab" data-toggle="tab" aria-controls="article" aria-expanded="true">
            Article
            </a>
        </li>

        <li role="presentation" class="">
            <a  href="#photo" role="tab" id="photo-tab" data-toggle="tab" aria-controls="photo" aria-expanded="false">
            Photo
            </a>
        </li>

        <li role="presentation" class="">
            <a href="#verset" id="verset-tab" role="tab" data-toggle="tab" aria-controls="verset" aria-expanded="true">
                God frist
                </a>
            </li>
    </ul>


    <div class="tab-content" id="myTabContent">

        <div class="tab-pane fade active in" role="tabpanel" id="article" aria-labelle$dby="article-tab">

            <div class="box box-primary   ng-panel-active ">
                <div class="box-header">
                    <h3 class="box-title">Publier un article</h3>

                    <?php if(isset($msg)){ echo "<p style='color:red;'>".$msg."</p>"; }else{ echo "<p>Exprimez vous en long et en large </p>";}?>

                </div>
                <div class="box-body">
                    <form action="" method="post" enctype="multipart/form-data" >

                        <div class="form-group">
                            <label for="titre">Titre</label>
                            <input  class="form-control" type="text" name="titre"

                            <?php if(isset($_POST['titre'])){?> value="<?= $_POST['titre'] ?>" <?php
                            }else if($editionMODE ==1){?> value="<?= $articleEDIT['titre'] ?>"<?php }?> />
                        </div>

                        <div>

                            <label for="contenu">Contenu</label>
                            <textarea class="textarea-default" placeholder="contenu..." name="contenu" id="contenu" style="width: 100%; height: 205px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"><?php
                            if(isset($_POST['contenu'])){ echo $_POST['contenu'];}
                            else if($editionMODE==1){ echo $articleEDIT['contenu'];} ?></textarea>

                        </div>
                        <br>

                        <div class="form-group">
                            <?php if($editionMODE==0){?>
                                <label for="miniature" class="btn btn-primary btn-block btn-flat ng-file-label">Ajouter une photo
                                <input class="ng-file-input"  type="file" name="miniature" id="miniature"/>
                                </label>
                            <?php }?>
                        </div>

                        <div class="box-footer clearfix">
                            <button type="reset" class="pull-right btn btn-sm btn-default" id="">Annuler</button>
                            <button type="submit" name="Publier" class="pull-right btn btn-primary ng-user-btn btn-sm" id="">Publier</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>

        <div class="tab-pane fade" role="tabpanel" id="photo" aria-labelle$dby="photo-tab">

            <div class="box box-primary ng-panel-active">
                <div class="box-header">
                    <h3 class="box-title">Publier une photo</h3>
                    <?php if(isset($msg1)){ echo "<p style='color:red;'>".$msg1."</p>"; }else{ echo "<p>Publie une photo et tag tes amis</p>";}?>
                </div>
                <div class="box-body">
                    <form method="post" action="" enctype="multipart/form-data">

                        <div class="form-group">
                            <label for="image" class="btn btn-primary btn-block btn-flat ng-file-label">Choisir une photo</label>
                            <input type="file" name="image" class="ng-file-input" id="image"/>
                        </div>

                        <label for="tags">Description</label>
                        <textarea type="text" class="textarea-default" name="tags" placeholder="Petite description... tags..."><?php if(isset($_POST['tags'])){ echo $_POST['tags'];}?></textarea>

                        <div class="box-footer clearfix">
                            <button type="reset" class="pull-right btn btn-sm btn-default" id="resetphoto">Annuler</button>
                            <button type="submit" name="pub_photo" class="pull-right btn btn-primary ng-user-btn btn-sm" id="">Poster</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>

        <div class="tab-pane fade" role="tabpanel" id="verset" aria-labelle$dby="verset-tab">
            <div class="box box-primary ng-panel-active">
                <div class="box-header">
                    <h3 class="box-title">Partager un Verset</h3>
                    <?php if(isset($msg2)){ echo "<p style='color:red;'>".$msg2."</p>"; }else{ echo "<p>Partage des versets...</p>";}?>
                </div>
                <div class="box-body">
                    <form method="post" action="" >


                        <label for="verset">contenu</label>
                        <textarea type="text" class="textarea-default" name="verset" placeholder="Petite description... verset..."><?php if(isset($_POST['verset'])){ echo $_POST['verset'];}?></textarea>

                        <div class="form-group">
                            <label for="ref">référence</label>
                            <input  class="form-control" type="text" name="ref"

                            <?php if(isset($_POST['ref'])){?> value="<?= $_POST['ref'] ?>" <?php
                            }else if($editionMODE ==1){?> value="<?= $articleEDIT['ref'] ?>"<?php }?> />
                        </div>

                        <div class="box-footer clearfix">
                            <button type="reset" class="pull-right btn btn-sm btn-default" id="resetphoto">Annuler</button>
                            <button type="submit" name="partager" class="pull-right btn btn-primary ng-user-btn btn-sm" id="">Partager</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>



<div class="row">
    <div class="col-md-6">
        <div class="box box-primary direct-chat direct-chat-primary ng-panel-active">
            <div class="box-header with-border">
                <h4 class="box-title"><span class="glyphicon glyphicon-chevron-right"></span> CHAT-GENERAL</h4>
            </div>

            <div class="box-body">
                <div class="direct-chat-messages chatboxx">
                    <ol class="chat">

                        <?php $all = $db->query("SELECT * from chat order by date_pub ");
                        while($msg = $all->fetch()) {?>

                        <?php if($msg['userID'] != $_SESSION['id']){?>

                            <li class="other">
                                <div class="avatar">
                                    <a href="pages/membres/profil.php?id=<?= $msg['userID'] ?>">
                                    <img src="pages/membres/Avatar/40-40/<?= getUserProfil($msg['userID']) ?>" draggable="false"/>
                                    </a>
                                </div>
                                <div class="msg">
                                    <p><?= nl2br(user_mention_verif($msg['message']))?></p>
                                    <time><?= getRelativeTime($msg['date_pub'])?></time>
                                </div>
                            </li>

                        <?php }else if($msg['userID'] == $_SESSION['id']){?>

                            <li class="self">
                                <div class="msg">
                                    <p><?= nl2br(user_mention_verif($msg['message']))?></p>
                                    <time><?= getRelativeTime($msg['date_pub'])?></time>
                                </div>
                            </li>

                        <?php } ?>
                        <?php } ?>

                    </ol>
                </div>
            </div>
            <div class="box-footer">
                <form  action="" method="POST">
                    <textarea class="textarea-default-chat" name="message" placeholder="Message..."/></textarea>

                    <button class="btn btn-primary" type="submit" value="" name="message1" >
                        <span class="glyphicon glyphicon-send"></span>
                    </button>

                    <button class="btn btn-primary"><span class="glyphicon glyphicon-paperclip"></span></button>

                    <button class="btn btn-primary pull-right" type="reset">
                        <span class="glyphicon glyphicon-remove"></span>
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- dernier membres ici -->
    <div class="col-md-6">
        <div class="box box-primary ng-panel-active">
            <div class="box-header with-border" >
                <h4 class="box-title"><span class="glyphicon glyphicon-chevron-right"></span> DERNIER MEMBRES</h4>
            </div>
            <div class="box-body no-padding chatboxx"">
                <ul class="users-list clearfix">
                <?php while($m = $membres->fetch()){?>
                    <li>
                        <img src="pages/membres/Avatar/90-90/<?= getUserProfil($m['id']) ?>" width="90" height="90">
                        <a class="users-list-name" href="pages/membres/profil.php?id=<?= $m['id'] ?>"><?= getUserPseudo($m['id'])?></a>
                    </li>
                <?php }?>
                </ul>
            </div>

            <div class="box-footer text-center">
                <a href="/admin/gestion/gestion-membres.php" class="uppercase">Voir plus</a>
            </div>
        </div>
    </div>




</div>
</div>


<div class="col-md-6">
    <div class="box box-primary ng-panel-active">
        <div class="box-header with-border">
            <h4 class="box-title"><span class="glyphicon glyphicon-asterisk"></span> IDEES</h4>
        </div>
        <div class="box-body">
            <ul class="products-list product-list-in-box">
            <?php for($i = 5; $ids = $idee->fetch();$i--){?>
                <li class="item ">
                    <div class="product-img">
                        <img src="pages/membres/Avatar/40-40/<?= getUserProfil($ids['userID'])?>" class="img img-circle">
                    </div>
                    <div class="product-info">
                        <a class="product-title"><?= getUserPseudo($ids['userID']) ?></a>
                         <span class="product-description">
                            <?php echo nl2br(user_mention_verif($ids['idee']))?>
                        </span>
                    </div>
                </li>
            <?php }?>
            </ul>
        </div>
        <div class="box-footer text-center">
            <a class="uppercase" href="/admin/gestion/gestion-idees.php">Voir plus</a>
        </div>
    </div>
</div>

<div class="col-md-6">
    <div class="box box-primary ng-panel-active">
        <div class="box-header with-border">
            <h4 class="box-title"><span class="glyphicon glyphicon-chevron-right"></span> PROBLEMES</h4>
        </div>
        <div class="box-body">
            <ul class="products-list product-list-in-box">
                <?php for($i = 2; $bleme = $problemes ->fetch();$i--){?>
            <li class="item">
                <div class="product-img">
                    <img src="pages/membres/Avatar/40-40/<?= getUserProfil($bleme['userID'])?>" class="img img-circle">
                </div>
                <div class="product-info">
                    <a class="product-title"><?= getUserPseudo($bleme['userID']) ?></a>
                    <span class="product-description">
                        <?php echo nl2br(user_mention_verif($bleme['probleme'])) ;?>
                        <hr>
                        <?php echo "statut: ".$bleme['statut']; ?>
                    </span>
                </div>
            </li>
              <?php }?>
            </ul>
        </div>
            <div class="box-footer text-center">
              <a class="uppercase" href="/admin/gestion/gestion-probleme.php">Voir plus</a>
            </div>
    </div>
</div>



</div>
</section>


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
