<?php

use Core\App;
use Core\Response;
use Core\Validator;

$id = htmlspecialchars(trim($_POST['id'])) ?? null;

if (!Validator::number($id)) {
    error_log("Error: failed to update todo due to missing parameters");
    abort(Response::BAD_REQUEST, 400);
}

try {
    $database = App::resolve(\Core\Database::class);
    $sql = 'DELETE FROM TASKS WHERE id = :id AND user_id = :user_id';
    $user_id = $_SESSION['user']['id'];
    $stmt = $database->query($sql, [ ':id' => $id,':user_id' => $user_id]);

    // Redirection après suppression
    redirect("/todos");

} catch (PDOException $e) {
    error_log($e->getMessage());
    abort(Response::INTERNEL_SERVER_ERROR);
}
