<?php
require SRC."/init.php";

if (!isset($_SESSION['id']) && empty($_SESSION['id'])) {
    header("location: /login");
    $_SESSION['msg'] = "vous devez vous connecter!";
    $_SESSION['type'] = "alert alert-danger";
}
