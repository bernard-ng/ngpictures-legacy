<?php
session_start();

if(isset($_SESSION['id']) and !empty($_SESSION['id']))
{
	$file = htmlspecialchars($_GET['n']);
	$file_tmp = "../..pages/galerie/ngimages/miniature/"."$file";

	header('Content-Type: application/octet-stream');
	header('Content-Transfer-Encoding: Binary');
	header('content-disposition: attachement; filename="'.basename($file_tmp).'"');
	echo readfile($file_tmp);

}else{

	$_SESSION['msg'] = "vous devez vous connecter !";
	$_SESSION['type'] = "alert-danger";
	header('location:../..pages/membres/login.php');
}


?>
