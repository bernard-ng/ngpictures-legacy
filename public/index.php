<?php

define("ROOT", dirname(__DIR__));
define("WEBROOT", __DIR__);
define("VIEW", ROOT."/src/pages");
define("SRC", ROOT."/src");


//chargment des routes de l'application
require(SRC."/config/routes.php");

// routing proprement dit.
if (isset($_SERVER['REQUEST_URI']) && !empty($_SERVER['REQUEST_URI'])) {
    $url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

    if ($url !== '/' && file_exists(__DIR__ . '/public' . $url)) :
        return false;
    endif;

    if (isset($_SERVER['REQUEST_METHOD']) && !empty($_SERVER['REQUEST_METHOD'])) {
        foreach ($routes as $route) {
            if ($route['method'] === strtolower($_SERVER['REQUEST_METHOD'])) {
                $path = trim($route['path'], '/');
                $path = "#^{$path}$#";

                if (preg_match($path, trim($url, '/'))) {
                    call_user_func($route['action']);
                    exit();
                }
            }
        }
    } else {
        require(VIEW . "/plus/erreur/500.php");
    }

    //si aucune route, alors on renvoie la page 404
    require(VIEW . "/plus/erreur/404.php");

} else {
    require(VIEW."/plus/erreur/500.php");
}
