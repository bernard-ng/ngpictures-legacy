<?php

	session_start();

	setcookie("mdp"," ",time()-3600);
	setcookie("pseudo"," ",time()-3600);

	unset($_SESSION['id']); // pour etre sur qu'il est vraiment deconnecter...
	$_SESSION = array();
	session_destroy();
	header('location:../..pages/membres/login.php');

?>
