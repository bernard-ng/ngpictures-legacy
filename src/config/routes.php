<?php

$routes = [
    [
        'path' => '/home',
        'method' => 'get',
        "action" => function () {
            include VIEW . "/index.php";
        }
    ],
    [
        'path' => '/login',
        'method' => 'get',
        'action' => function () {
            include VIEW."/membres/login.php";
        }
    ],
    [
        'path' => '/login',
        'method' => 'post',
        'action' => function () {
            include VIEW . "/membres/login.php";
        }
    ],[
        'path' => "/actualite",
        'method' => 'get',
        'action' => function () {
            include VIEW."/article/actualite.php";
        }
    ]
];
