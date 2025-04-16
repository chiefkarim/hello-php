<?php

use Core\App;
use Core\Response;

require base_path("config.php");


try {
    $database = App::resolve(\Core\Database::class);
    $id = $_GET['id'];
    $todo = $database->query("SELECT * FROM TASKS WHERE id=:id", ["id" => $id])->fetchOrAbort();
    $currentUserId = 2;
    authorize($todo['user_id'] === $currentUserId, Response::NOT_AUTHORIZED);
} catch (PDOException  $pe) {
    error_log($e->getMessage());
    todo(Response::INTERNEL_SERVER_ERROR);
    exit;
}
view("todos/todo/show.view.php", ["todo" => $todo]);
