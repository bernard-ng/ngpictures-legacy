<?php require("src/publication-users.php"); ?>
<!DOCTYPE html>
<html>
<head>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width" />
    <?php include "../includes/favicon.php";?>
    <?php include '../includes/all-meta.php'; ?>
    <title><?php if($editionMODE == 1){echo "Edition";}else{ echo "Publication";}?></title>

    <link rel="stylesheet" href="/assets/css/AdminLTE.min.css">
    <link rel="stylesheet" href="/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="/assets/css/ng.css">

</head>
<body>
    <?php include "../includespages/article/menu-publication.php"; ?>
    <?php include "../includes/flash.php"; ?>

<div class="jumbotron ng-margin-default">
    <div class="media">
        <div class="container">
            <div class="media-body" >

            <h2 class="media-heading" style="color:#428bca;"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>  <?php if($editionMODE == 1){echo "Edition";}else{ echo "Publication";}?></h2>

            hey! <b><?= getUserPseudo($_SESSION['id'])?></b>,ici tu peux publier ou éditer tes articles et tes photos, qui seront vu dans la rubrique actualités pour tes articles et dans la rubrique galerie pour tes photos...

            </div>
        </div>
    </div>
</div>
<section class="ng-bloc-principal container">
<?php include '../includes/verset.php'; ?>
<!-- statut et information -->
      <div class="col-xs-12 col-lg-3 col-sm-3  col-md-3">
      <div class="row">

            <form class="input-group ng-panel-info" method="get" action="pages/membres/recherche.php">
                  <input name="q" type="text" class="form-control" placeholder="recherche">
                  <span class="input-group-btn" >
                  <button  type="submit" class="btn btn-primary ng-input" type="button"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
                  </span>
            </form>

            <div class="ng-alert ng-panel panel panel-primary">
                  <div class=" ng-panel panel-heading ng-margin-default"><span class="glyphicon glyphicon-chevron-right"></span>  MES PUBLICATIONS</div>

                  <ul class="list-group ng-margin-default">

                        <li class="list-group-item"><span class="glyphicon glyphicon-pencil"></span>
                        <a>Articles</a><span class="badge ng-badge">
                              <?= KMF(getArticleInfo($_SESSION['id'],"nombre")) ?>
                              </span>
                        </li>
                        <li class="list-group-item">
                              <span class="glyphicon glyphicon-camera"></span>
                              <a href="/galerie?id=<?= $_SESSION['id'] ?>">photos</a><span class="badge ng-badge">
                                  <?= KMF(getPicturesInfo($_SESSION['id'],"nombre")) ?>
                              </span>
                        </li>
                  </ul>
            </div>
<!-- / statut et information -->

<div class="hidden-xs">
<?php include "../includes/last-ngpictures.php"; ?>
</div>

</div>
</div>


<div class="col-xs-12 col-md-9 col-sm-9 col-lg-9" >
<div class="row">

<div class="ng-margin">
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
    </ul>


    <div class="tab-content" id="myTabContent">

        <div class="tab-pane fade active in" role="tabpanel" id="article" aria-labelle$dby="article-tab">
            <div class="box box-primary   ng-panel-active ">
                <div class="box-header">

                    <h3 class="box-title">Publier un article</h3>

                    <?php if(isset($msg)){ echo "<p style='color:red;'>".$msg."</p>"; }else{ echo "<p>Exprimez vous en long et en large </p>";}?>
                    <?php if(isset($_SESSION['msg']))
                    { echo "<p style='color:red;'>".$_SESSION['msg']."</p>"; unset($_SESSION['msg']) ; unset($_SESSION['type']) ;
                    }else{"<p>Exprimez vous en long et en large</p>";}?>

                </div>
                <div class="box-body">
                    <form action="" method="post" enctype="multipart/form-data" >

                        <div class="form-group">
                            <label for="titre">Titre</label>
                            <input  class="form-control"   type="text" name="titre"

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
                            <button type="submit" name="pub_photo" class="pull-right btn btn-primary ng-user-btn btn-sm" id="">Publier</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>
</div>
</div>

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
