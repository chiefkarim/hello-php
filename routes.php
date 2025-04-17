<?php

$router->get("/", "controllers/home.php");

$router->get("/todos", "controllers/todos/index.php")->middleware("auth");
$router->delete("/todos", "controllers/todos/destroy.php")->middleware("auth");
$router->patch("/todos", "controllers/todos/update.php")->middleware("auth");
$router->post("/todos", "controllers/todos/store.php")->middleware("auth");


$router->get("/todo", "controllers/todos/todo/show.php")->middleware("auth");
$router->patch("/todo", "controllers/todos/todo/update.php")->middleware("auth");

$router->get("/register", "controllers/register/index.php")->middleware("guest");
$router->post("/register", "controllers/register/store.php")->middleware("guest");

$router->get("/login", "controllers/login/create.php")->middleware("guest");
$router->post("/login", "controllers/login/store.php")->middleware("guest");
$router->delete("/logout", "controllers/logout/destroy.php")->middleware("auth");
