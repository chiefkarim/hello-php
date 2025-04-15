<?php

$router->get("/", "controllers/home.php");

$router->get("/todos", "controllers/todos/index.php");
$router->delete("/todos", "controllers/todos/delete.php");
$router->patch("/todos", "controllers/todos/update.php");
$router->post("/todos", "controllers/todos/insert.php");


$router->get("/todo", "controllers/todos/show.php");
