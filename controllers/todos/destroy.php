<?php

use Core\App;
use Core\Response;
use Core\Validator;

require_once base_path('config.php');

$id = htmlspecialchars(trim($_POST['id'])) ?? null;

if (!Validator::number($id)) {
    error_log("Error: failed to update todo due to missing parameters");
    abort(Response::BAD_REQUEST, 400);
}

try {
    $database = App::resolve(\Core\Database::class);
    $sql = 'DELETE FROM TASKS WHERE id = :id AND user_id = :user_id';
    $stmt = $database->conn->prepare($sql);
    $stmt->execute([ ':id' => $id,':user_id' => 2]);

    // Redirection après suppression
    header("Location: /todos");
    exit;

} catch (PDOException $e) {
    error_log($e->getMessage());
    http_response_code(Response::INTERNAL_SERVER_ERROR);
    echo json_encode(["error" => "Une erreur est survenue lors de la suppression."]);
    exit;
}
