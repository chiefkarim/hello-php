<?php

require base_path("routes.php");

use Core\Response;

$uri = $_SERVER["REQUEST_URI"];
$path = parse_url($uri)['path'];

function abort($status = Response::NOT_FOUND)
{
    http_response_code($status);
    view("$status.php");
    die();
}

function pathToController($path, $routes)
{
    if (array_key_exists($path, $routes)) {
        include base_path($routes[$path]);
    } else {
        abort(404);
    }
}

pathToController($path, $routes);
