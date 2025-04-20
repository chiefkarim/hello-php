<?php

session_start();

use Core\Session;

const BASE_PATH = __DIR__ . "/../";

require BASE_PATH . "Core/functions.php";

spl_autoload_register(
    function ($class) {
        $class = str_replace("\\", DIRECTORY_SEPARATOR, $class);
        include base_path("$class.php");
    }
);

require base_path("bootstrap.php");

function abort($status = Response::NOT_FOUND)
{
    http_response_code($status);
    view("$status.php");
    die();
}

$uri = parse_url($_SERVER["REQUEST_URI"])['path'];

$router = new \Core\Router();

$routes = require base_path("routes.php");

$method = $_POST['_method'] ?? $_SERVER['REQUEST_METHOD'];

$router->route($uri, $method);

Session::expire();
