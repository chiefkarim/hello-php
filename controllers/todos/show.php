<?php

require base_path("config.php");


try {
    $database = new Database($config, $username, $password);
    $id = $_GET['id'];
    $todo = $database->query("SELECT * FROM TASKS WHERE id=:id", ["id" => $id])->fetchOrAbort();
    $currentUserId = 2;
    authorize($todo['user_id'] === $currentUserId, Response::NOT_AUTHORIZED);
} catch (PDOException  $pe) {
    error_log("error while getting task!". $pe->getMessage());
    abort();
}
view("todos/show.view.php", ["todo" => $todo]);
