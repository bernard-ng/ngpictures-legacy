<?php
session_start();
require "..helper/functions.php";
$db = base_connexion('ngbdd');

if(isset($_SESSION['id']) and !empty($_SESSION['id']))
{
		if(isset($_SERVER['HTTP_REFERER']) and !empty($_SERVER['HTTP_REFERER']))
		{

			if(isset($_GET['id']) and !empty($_GET['id']))
			{

				$deleteID= htmlspecialchars($_GET['id']);

				if(getArticleInfo($deleteID,"nb_article") == 1)
				{
					if(getArticleInfo($deleteID,"posterID") == $_SESSION['id'])
					{
						$delete=$db->prepare("delete from article where id=?");
						$delete->execute(array($deleteID));

						header('location:'.$_SERVER['HTTP_REFERER']);
						$_SESSION['msg'] = "votre article a bien été supprimé !";
						$_SESSION['type'] = "alert-success";
					}
					else{
							header('location:'.$_SERVER['HTTP_REFERER']);
							$_SESSION['msg'] = "Vous ne pouvez pas supprimer cet article";
							$_SESSION['type'] = "alert-danger"; }
				}
				else{

					header('location:'.$_SERVER['HTTP_REFERER']);
					$_SESSION['msg'] = "Cet Article n'existe pas";
					$_SESSION['type'] = "alert-danger";}

			}else{
					header('location:'.$_SERVER['HTTP_REFERER']);
					$_SESSION['msg'] = "Erreur dans la suppression !";
					$_SESSION['type'] = "alert-danger";}
		}else{
				header("location:../..pages/membres/profil.php?id=".$_SESSION['id']);
				$_SESSION['msg'] = "Selectionnez l'article à supprimer !";
				$_SESSION['type'] = "alert-danger"; }
}
else{

	header("location:..pages/membres/login.php");
	$_SESSION['msg'] = "Vous devez vous connecter !";
	$_SESSION['type'] = "alert-danger"; }

?>
