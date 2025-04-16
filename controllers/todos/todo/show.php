<?php

use Core\App;
use Core\Response;

try {
    $database = App::resolve(\Core\Database::class);
    $id = $_GET['id'];
    $todo = $database->query("SELECT * FROM TASKS WHERE id=:id", ["id" => $id])->fetchOrAbort();
    $currentUserId = $_SESSION['user']['id'];
    authorize($todo['user_id'] === $currentUserId, Response::NOT_AUTHORIZED);
} catch (PDOException  $pe) {
    error_log($e->getMessage());
    aort(Response::INTERNEL_SERVER_ERROR);
}
view("todos/todo/show.view.php", ["todo" => $todo]);
