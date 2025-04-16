<?php

$router->get("/", "controllers/home.php");

$router->get("/todos", "controllers/todos/index.php");
$router->delete("/todos", "controllers/todos/destroy.php");
$router->patch("/todos", "controllers/todos/update.php");
$router->post("/todos", "controllers/todos/store.php");


$router->get("/todo", "controllers/todos/todo/show.php");
$router->patch("/todo", "controllers/todos/todo/update.php");
