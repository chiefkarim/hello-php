<?php
require_once 'connect.php';

// Read JSON input
$input = file_get_contents("php://input");
$data = json_decode($input, true);

// Debugging logs
error_log("Raw JSON data: " . $input);

$id = $data['id'] ?? null;
$completed = $data['completed'] ?? null;

error_log("Received ID: " . ($id !== null ? $id : 'undefined'));
error_log("Received Completed: " . ($completed !== null ? $completed : 'undefined'));

if ($id === null || $completed === null) {
    echo json_encode(["status" => "error", "message" => "Missing parameters"]);
    exit;
}

try {
    $sql = 'UPDATE TASKS SET completed = :completed WHERE id = :id;';
    $stmt = $conn->prepare($sql);
    $stmt->execute([":completed" => $completed, ":id" => $id]);

    echo json_encode(["status" => "success"]);
} catch (PDOException $e) {
    error_log("DB Error: " . $e->getMessage());
    echo json_encode(["status" => "error", "message" => "Database error"]);
}
?>

