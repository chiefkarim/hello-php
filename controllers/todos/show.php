<?php

require "config.php";


try {
    $database = new Database($config, $username, $password);
    $id = $_GET['id'];
    $task = $database->query("SELECT * FROM TASKS WHERE id=:id", ["id" => $id])->fetchOrAbort();
    $currentUserId = 2;
    authorize($task['user_id'] === $currentUserId, Response::NOT_AUTHORIZED);
} catch (PDOException  $pe) {
    error_log("error while getting task!". $pe->getMessage());
    abort();
}
require "views/todos/show.view.php";
