<?php

use Core\Response;
use Core\Validator;
use Core\App;

$id = htmlspecialchars(trim($_POST['id'])) ?? null;
$completed = htmlspecialchars(trim($_POST['completed'])) ?? null;

if (!Validator::number($id) || !Validator::number($completed)) {
    error_log("Error: failed to update todo due to missing parameters");
    abort(Response::BAD_REQUEST, 400);
}

try {
    $database = App::resolve(\Core\Database::class);
    $sql = 'UPDATE TASKS SET completed = :completed WHERE id = :id;';
    $stmt = $database->query($sql, [":completed" => $completed, ":id" => $id]);
    include base_path('Html/controllers/todos/index.php');
    exit;
} catch (PDOException $e) {
    error_log($e->getMessage());
    abort(Response::INTERNEL_SERVER_ERROR);
    exit;
}
