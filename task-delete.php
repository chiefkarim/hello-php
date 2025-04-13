<?php

require_once 'Database.php';
require_once 'config.php';
require_once 'Response.php';

// Récupérer l'ID de la tâche
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
    header("Location: /tasks");
    exit;

} catch (PDOException $e) {
    error_log($e->getMessage());
    http_response_code(Response::INTERNAL_SERVER_ERROR);
    echo json_encode(["error" => "Une erreur est survenue lors de la suppression."]);
    exit;
}
