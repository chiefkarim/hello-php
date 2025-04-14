<?php

require "routes.php";

$uri = $_SERVER["REQUEST_URI"];
$path = parse_url($uri)['path'];



function pathToController($path, $routes)
{
    if (array_key_exists($path, $routes)) {
        include $routes[$path];
    } else {
        abort(404);
    }
}

pathToController($path, $routes);
