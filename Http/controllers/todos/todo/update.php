<?php

use Core\Response;
use Core\Validator;
use Core\App;

$id = htmlspecialchars(trim($_POST['id'])) ?? null;
$title = htmlspecialchars(trim($_POST['title'])) ?? null;
$errors = [];

if (!Validator::number($id)) {
    abort(Response::NOT_FOUND);
}
try {
    $database = App::resolve(\Core\Database::class);
    $todo = $database->query("SELECT * FROM TASKS WHERE id=:id", ["id" => $id])->fetchOrAbort();
    $currentUserId = $_SESSION['user']['id'];
    authorize($todo['user_id'] === $currentUserId, Response::NOT_AUTHORIZED);
} catch (PDOException  $pe) {
    error_log($e->getMessage());
    abort(Response::INTERNEL_SERVER_ERROR);
    exit;
}

if (!Validator::string($title)) {
    $errors[] = "Error: failed to update todo due to missing parameters";
    view("todos/todo/show.view.php", ["todo" => $todo,"errors" => $errors]);
    exit;
}

try {
    $sql = 'UPDATE TASKS SET title = :title WHERE id = :id;';
    $stmt = $database->query($sql, [":title" => $title, ":id" => $id]);
    header("Location: /todo?id=$id");
    exit;

} catch (PDOException $e) {
    error_log($e->getMessage());
    abort(Response::INTERNEL_SERVER_ERROR);
    exit;
}
