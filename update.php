<?php
require_once 'Database.php';
require_once 'config.php';

// Read JSON input
$input = file_get_contents("php://input");
$data = json_decode($input, true);

// Debugging logs
error_log("Raw JSON data: " . $input);

$id = $data['id'] ?? null;
$completed = $data['completed'] ?? null;

if ($id === null || $completed === null) {
    //should return status code and error message to the user
    error_log("Error: Missing parameters");
    exit;
}

try {
    $database = new Database($config, $username, $password);
    $sql = 'UPDATE TASKS SET completed = :completed WHERE id = :id;';
    $stmt = $database->conn->prepare($sql);
    $stmt->execute([":completed" => $completed, ":id" => $id]);

} catch (PDOException $e) {
    error_log("DB Error: " . $e->getMessage());

}
?>

