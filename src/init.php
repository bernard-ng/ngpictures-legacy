<?php

// demarrage de la session, si c'est pas encore fait.
if (session_status() === PHP_SESSION_NONE) {
    session_name('NGPICTURES-SESSID');
    session_start();
}


//connexion a la base de donnee
$get_database_connexion = function ($name , $host = 'localhost', $user = 'root', $password = '') {
    try {
        $bdd = new PDO("mysql:host={$host};dbname={$name};charset=utf8", "{$user}", "{$password}");
        $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $bdd->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        $bdd->setAttribute(PDO::ATTR_ORACLE_NULLS, PDO::NULL_EMPTY_STRING);

        return $bdd;
    } catch (PDOException $e) {
        die($e->getMessage());
    }
};

$db = $get_database_connexion('oldversion');


//chargement des script important
require SRC.'/helper/functions.php';
require_once SRC.'/script/cookie.php';
require SRC.'/script/online.php';
