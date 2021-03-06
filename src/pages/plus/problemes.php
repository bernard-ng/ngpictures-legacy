<?php
session_start();
require '../src/helper/functions.php';
$db = base_connexion('ngbdd');

if(isset($_SESSION['id']) and !empty($_SESSION['id'])) {

    if(isset($_POST['submit_blem'])) {

        if(!empty($_POST['probleme'])) {

            $userID = htmlspecialchars($_SESSION['id']);
            $probleme = htmlspecialchars($_POST['probleme']);
            $insert = $db->prepare('INSERT into problemes(userID,probleme,date_pub) values(?,?,now())');
            $insert->execute(array($userID,$probleme));

            $_SESSION['msg'] = "Nous avons reçu votre problème";
            $_SESSION['type'] = "alert-success";
            header("location:/index.php");

        }else{
            $msg = "complétez le champ";
            $type = "alert-danger";
        }

    }

?>
<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="viewport" content="width=device-width" />
    <?php include '../includes/favicon.php';?>
    <?php include '../includes/all-meta.php'; ?>
  <title>Problème</title>

  <link rel="stylesheet" href="/assets/css/AdminLTE.min.css">
  <link href="/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" >
  <link href="/assets/css/ng.css" rel="stylesheet" type="text/css" >

</head>
<body>
<section class="ng-bloc-principal">

<?php include '../includes/menu.php'; ?>
<?php include '../includes/flash.php'; ?>

<div class="jumbotron ng-margin-default">
  <div class="media">
      <div class="container">
          <div class="media-body" >
              <h2 class="media-heading" style="color:#428bca;"><span class="glyphicon glyphicon-exclamation-sign aria-hidden="true"></span> Signaler un problème</h2>
              Salut <b><?php echo getUserPseudo($_SESSION['id']) ?></b>, si une de nos fonctionnalités, ne fonctionne pas comme prévu, veuillez nous en informer...
          </div>
      </div>
  </div>
</div>
<?php include '../includes/verset.php'; ?>


<div class="container">
  <form action="#" method="POST">
      <div class="form-group">
          <textarea type="text" class="textarea-default" id="probleme" name="probleme" placeholder="veuillez aussi nous détailler les étapes qui pourrons nous aider à reproduire le même problème..."><?php if(isset($_POST['id'])) { echo $_POST['id']; 
         }?></textarea>
      </div>
      <div class="row">
          <div class="col-xs-12">
              <button type="submit" class="btn btn-primary btn-block btn-flat" name="submit_blem">Envoyer</button>
          </div>
      </div>
  </form>
</div>

<div class="ng-espace-fantom"></div>
</section>
<?php include '../includes/footer.php'; ?>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script>
      window.jQuery || document.write('<script src="../assets/js/js+/jquery.min.js"><\/script>')
</script>
<script src="/assets/js/bootstrap.min.js"></script>
<script src="/assets/js/ng-alert-V2.js"></script>

</body>
</html>
<?php

}else{

    $_SESSION['msg'] = "vous devez vous connecter !";
    $_SESSION['type'] = "alert-danger";
    header('location:pages/membres/login.php');
}

?>
