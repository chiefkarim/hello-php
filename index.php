<?php

require "functions.php";

$uri = $_SERVER["REQUEST_URI"];

$path = parse_url($uri)['path'];

$routes = [
  "/" => "controllers/home.php",
  "/tasks" => "controllers/select.php"
];

if (array_key_exists($path, $routes)) {
    include $routes[$path];
} else {
    abort(404);
}
