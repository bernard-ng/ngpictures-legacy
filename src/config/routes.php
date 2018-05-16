<?php

$routes = [
    [
        'path' => '/home',
        'method' => 'get',
        "action" => function () {
            require VIEW . "/index.php";
        }
    ],
    [
        'path' => '/login',
        'method' => 'get',
        'action' => function () {
            require VIEW."/membres/login.php";
        }
    ],
    [
        'path' => '/login',
        'method' => 'post',
        'action' => function () {
            require VIEW . "/membres/login.php";
        }
    ],[
        'path' => "/actualite",
        'method' => 'get',
        'action' => function() {
            require VIEW."/article/actualite.php";
        }
    ]
];
