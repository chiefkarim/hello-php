<?php

use Core\Database;
use Core\Response;

require_once base_path('config.php');

$id = $_POST['id'] ?? null;

if (!$id || !is_numeric($id)) {
    http_response_code(Response::BAD_REQUEST);
    echo json_encode(["error" => "ID de tâche invalide."]);
    exit;
}

try {
    $database = new Database($config, $username, $password);
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
