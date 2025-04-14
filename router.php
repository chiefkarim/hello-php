<?php

$uri = $_SERVER["REQUEST_URI"];

$path = parse_url($uri)['path'];

$routes = [
  "/" => "controllers/home.php",
  "/todos" => "controllers/todos/index.php",
  "/todo" => "controllers/todos/show.php",
  "/todos/delete" => "controllers/todos/delete.php",
  "/todos/update" => "controllers/todos/update.php",
  "/todos/insert" => "controllers/todos/insert.php",
];

if (array_key_exists($path, $routes)) {
    include $routes[$path];
} else {
    abort(404);
}
