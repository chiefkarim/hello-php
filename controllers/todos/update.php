<?php

use Core\Database;
use Core\Response;

require_once base_path('config.php');

$id = htmlspecialchars(trim($_POST['id'])) ?? null;
$completed = htmlspecialchars(trim($_POST['completed'])) ?? null;

if ($id == null || $completed == null) {
    error_log("Error: failed to update todo due to missing parameters");
    abort(Response::BAD_REQUEST, 400);
}

try {
    $database = new Database($config, $username, $password);
    $sql = 'UPDATE TASKS SET completed = :completed WHERE id = :id;';
    $stmt = $database->conn->prepare($sql);
    $stmt->execute([":completed" => $completed, ":id" => $id]);
    include base_path('controllers/todos/index.php');
    exit;

} catch (PDOException $e) {
    error_log("DB Error: " . $e->getMessage());
}
?>

