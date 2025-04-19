<?php

$router->get("/", "home.php");

$router->get("/todos", "todos/index.php")->middleware("auth");
$router->delete("/todos", "todos/destroy.php")->middleware("auth");
$router->patch("/todos", "todos/update.php")->middleware("auth");
$router->post("/todos", "todos/store.php")->middleware("auth");


$router->get("/todo", "todos/todo/show.php")->middleware("auth");
$router->patch("/todo", "todos/todo/update.php")->middleware("auth");

$router->get("/register", "register/index.php")->middleware("guest");
$router->post("/register", "register/store.php")->middleware("guest");

$router->get("/login", "login/create.php")->middleware("guest");
$router->post("/login", "login/store.php")->middleware("guest");
$router->delete("/logout", "logout/destroy.php")->middleware("auth");
