<?php
session_start();
require "../src/helper/functions.php";
$db= base_connexion('ngbdd');

if(isset($_SESSION['id']) and !empty($_SESSION['id']))
{


			if(isset($_GET['id']) and !empty($_GET['id']))
			{
				$getID=htmlspecialchars($_GET['id']);
				$news=$db->prepare("SELECT * FROM galerie WHERE id=?");
				$news->execute(array($getID));

				$verif =htmlspecialchars($_SESSION['id']);
				$user=$db->prepare("SELECT * form membres where id=?");
				$user->execute(array($verif));
				$user= $user->fetch();

				if($news->rowcount() ==1)
				{
					$news = $news->fetch();
					$photoID= $news['id'];
					$poster= getUserPseudo($news['userID']);

					if(isset($_POST['cmtSubmit']))
					{

						if(isset($_POST['commentaire'],$_SESSION['id']) and !empty ($_POST['commentaire']) and !empty($_SESSION['id']))
						{

							$commentaire=htmlspecialchars($_POST['commentaire']);
							$ID=htmlspecialchars($_GET['id']);
							$userID= htmlspecialchars($_SESSION['id']);

							$insert= $db->prepare("insert into commentaire (commentaire,photoID,userID,date_pub) values (?,?,?,now()) ");
							$insert->execute(array($commentaire,$photoID,$userID));
							$msg="votre commentaire a bien été posté";
							$type="alert-success";

						}
						else{
							$msg="completez le champ";
							$type="alert-danger";
						}

					}

					$commentaire= $db->prepare("SELECT * from commentaire where photoID=? order by date_pub desc ");
					$commentaire->execute(array($photoID));

					$comN = $db->prepare("SELECT * from commentaire where photoID=? order by date_pub desc ");
					$comN->execute(array($photoID));
					$com= $comN ->rowcount();

				}
				else{  header("location:pages/plus/erreur/404.php"); }

			}else{ header("location:pages/plus/erreur/500.php"); }

}else{

    header("location:pages/membres/login.php");
    $_SESSION['msg'] = "vous devez vous connecter!";
    $_SESSION['type'] = "alert alert-danger"; }
?>
<!doctype html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width" />
	<?php include "../includes/favicon.php";?>
	<?php include '../includes/all-meta.php'; ?>
	<title>COMMENTAIRES-<?= $titre ?></title>

	<link rel="stylesheet" href="../assets/css/AdminLTE.min.css">
	<link href="../assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" >
	<link href="../assets/css/ng.css" rel="stylesheet" type="text/css" >

</head>
<body>
<section class="ng-bloc-principal container">

<?php include "../includes/menu.php"; ?>
<?php include "../includes/flash.php"; ?>

<br>

<?php include '../includes/verset.php'; ?>


<div class="col-xs-12 col-sm-8 col-md-8 col-lg=8" >
	<div class="row">

	<div class="ng-panel panel-primary panel ng-panel-active">

	<div class="ng-panel panel-heading ng-margin-default">COMMENTAIRE<?= $t = (getPicturesInfo($photoID,"commentaire") > 1)? "S" : ""  ?> <span class="ng-badge badge"><?= $com ?></span></div>

	<ul class="list-group ng-margin-default">
			<?php while($c = $commentaire->fetch()){?>
				<li class="list-group-item">
					<div class="media">
					 	<div class="media-left media-top">
					    		<a href="..pages/membres/profil.php?id=<?= $c['userID']?>">
					      		<img class="media-object img img-circle" src="..pages/membres/Avatar/40-40/<?= getUserProfil($c['userID'])?>" width="40" height="40">
					    		</a>
					  	</div>
					  	<div class="media-body">


						    <a href="..pages/membres/profil.php?id=<?= $c['userID']?>">

						    <h5 class="media-heading"><?= getUserPseudo($c['userID'])?></h5></a>

						    <h6><?= nl2br(user_mention_verif($c ['commentaire'])) ?></h6>

						    <span class="pull-right">
						    <time><span class="glyphicon glyphicon-time"></span> <?= getRelativeTime($c['date_pub'])?></time></span>

					  	</div>
					</div>
				</li>
		<?php }?>
	</ul>
	</div>

	</div>
</div>

<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
	<div class="row">
		<div class="ng-panel panel panel-primary">
			<div class="ng-panel panel-heading ng-margin-default" role="tab" >
				<span class="glyphicon glyphicon-comment"></span> REAGIR
		    </div>
		    	<div class="box box-primary ng-margin-default">
		            <div class="box-body">
			            <form method="post" action="">
							<textarea class="textarea-default" rows="3" name="commentaire" placeholder="Votre commentaire"></textarea>

							<div class="box-footer clearfix">
								<span class="pull-right">
								<button type="submit" class="btn btn-primary btn-sm ng-btn-border" name="cmtSubmit" >Commenter</button>
								<button type="reset" class="btn btn-default btn-sm ng-btn-border" name="cmtSubmit" >Annuler</button>
								</span>
							</div>
						</form>
					</div>
				</div>
		</div>
	</div>
</div>

<div class="ng-espace-fantom"></div>
</section>
<?php include '../includes/footer.php'; ?>

<!--importation des script -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script>
    window.jQuery || document.write('<script src="../assets/js/js+/jquery.min.js"><\/script>')
    </script>
    <script src="../assets/js/bootstrap.min.js"></script>
    <script src="../assets/js/ng-alert-V2.js"></script>
<!-- /importation des script -->

</body>
</html>
