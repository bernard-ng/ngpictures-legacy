<?php require "src/profile-edit.php"; ?>
<!doctype html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="fr">
<head>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width" />
    <?php require "../includes/favicon.php";?>
    <?php require '../includes/all-meta.php'; ?>
    <title><?php echo "Edition profil | ".getUserPseudo($_SESSION['id']) ?></title>

    <link rel="stylesheet" href="/assets/css/AdminLTE.min.css">
    <link href="/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" >
    <link href="/assets/css/ng.css" rel="stylesheet" type="text/css" >

</head>
<body>
<?php require "../includes/profil/menu.php"; ?>
<?php require "../includes/flash.php"; ?>


<div class="jumbotron ng-margin-default">
    <div class="container">
        <div class="media">
            <div class="media-left media-middle">
                <div class="media-body" >
                    <h2 class="media-heading" style="color:#428bca;"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Edition du Profil</h2>
                        vous pouvez modifier les informations concernant votre compte ici...
                </div>
            </div>
        </div>
    </div>
</div>
<section class="ng-bloc-principal container">

<?php require '../includes/verset.php'; ?>

<div class="ng-article-img">
    <div class="hidden-xs col-lg-3 col-sm-3 col-md-3">
        <div class="row">
            <div class="ng-panel panel panel-primary">
                <div class="ng-panel panel-heading"><span class="glyphicon glyphicon-picture"></span>  PROFIL</div>
                <div class="ng-article-img">
                    <div class="card--date">
                        <div class="card--date--day"><?php echo getDay(getTodayDate())?></div>
                        <div class="card--date--month"><?php echo getMonth(getTodayDate());?></div>
                    </div>

                    <img class="img-circle" src="pages/membres/Avatar/640-640/<?php echo getUserProfil($_SESSION['id']) ?>" width="200" />

                </div>
            </div>
        </div>
    </div>
</div>

<div class="col-xs-12 col-md-6 col-sm-6 col-lg-6" >
    <div class="row">

    <div class="box box-primary ng-panel-active">
        <div class="box-header">
            <h3 class="box-title">Publier un statut</h3>

            <?php if(isset($msg)) { echo "<p style='color:red;'>".$msg."</p>"; 
            }else{ echo "<p>Edition du profil et publication statut </p>";
}?>
        </div>

        <div class="box-body">
            <form method="post" action="" enctype="multipart/form-data">

            <label for="statut">Statut</label>
            <textarea type="text" class="textarea-default" name="statut" placeholder="nouveau statut..."><?php if(isset($_POST['statut'])) { echo $_POST['statut'];
           }?></textarea>

           <div class="form-group">
               <label for="avatar" class="btn btn-primary btn-block btn-flat ng-file-label">Photo de profil</label>
               <input type="file" name="avatar" class="ng-file-input" id="avatar"/>
             </div>

            <div class="form-group has-fee$dback">
                <label for="pseudoupdate">Nouveau Pseudo</label>
                <input type="text" name="pseudoupdate" class="form-control" id="pseudoupdate"
                 value="<?php if(isset($_POST['pseudoupdate'])) { echo $_POST['pseudoupdate'];
                }else{ echo $user['pseudo'];
}?>">
                <span class="glyphicon glyphicon-user form-control-fee$dback"></span>
              </div>


            <div class="form-group has-fee$dback">
                <label for="numupdate">Nouveau Mobile</label>
                <input type="text" class="form-control" id="numupdate" name="numupdate"
                value="<?php if(isset($_POST['numupdate'])) { echo $_POST['numupdate'];
               }else{ echo $user['num'];
}?>">
                <span class="glyphicon glyphicon-phone form-control-fee$dback"></span>
            </div>


            <div class="form-group has-fee$dback">
                <label for="mdpupdate">ancien mot de passe</label>
                <input type="Password" name="mdpupdate" class="form-control" id="mdpupdate" placeholder="Password">
                <span class="glyphicon glyphicon-lock form-control-fee$dback"></span>
            </div>

            <div class="form-group has-fee$dback">
                <label for="mdp1update">nouveau</label>
                <input type="Password" name="mdp1update" class="form-control" id="mdp1update" placeholder="Password">
                <span class="glyphicon glyphicon-lock form-control-fee$dback"></span>
            </div>

            <div class="box-footer clearfix">

                <button  type="submit"  name="modifier" class="pull-right btn btn-primary btn-sm" role="button">Modifier</button>
                <button  type="reset"  name="reset" class="pull-right btn btn-default btn-sm" role="button">Annuler</button>
            </div>

            </form>
        </div>
    </div>

    </div>
</div>

<div class="col-xs-12 col-sm-3 col-md-3">
    <div class="row">
        <div class="ng-panel panel panel-primary">
            <div class="ng-panel panel-heading"><span class="glyphicon glyphicon-chevron-right"></span> STATUT</div>

            <div class="panel-body">
                <?php echo text($user['statut']) ?>
            </div>
        </div>
    </div>
</div>

<div class="col-xs-12 col-sm-3 col-md-3">
    <div class="row">
        <div class="ng-panel panel panel-primary ">
            <div class="ng-panel panel-heading ng-margin-default">
            <span class="glyphicon glyphicon-chevron-right"></span> PSEUDO ET AUTRE</div>

            <ul class="list-group">
                <li class="list-group-item"><span class="glyphicon glyphicon-user"></span>
                    <?php echo getUserName($_SESSION['id'])?>
                </li>

                <li class="list-group-item"><span class="glyphicon glyphicon-phone"></span>
                    <?php echo getUserPhone($_SESSION['id'])?>
                </li>

                <li class="list-group-item"><span class="glyphicon glyphicon-envelope"></span>
                    <a><?php echo getUserEmail($_SESSION['id'])?></a>
                </li>
            </ul>
        </div>
    </div>
</div>

<div class="ng-espace-fantom"></div>
</section>
<?php require "../includes/footer.php"; ?>

<!-- script -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script>
    window.jQuery || document.write('<script src="/assets/js/js+/jquery.min.js"><\/script>')
    </script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/ng-alert-V2.js"></script>
<!-- / script -->

</body>
</html>
