<?php

require_once 'Database.php';
require_once 'config.php';

// Read JSON input

$title = $_POST["title"] ?? null;
//Debugging logs
error_log("Raw JSON data: $title");

if (!$title) {
    http_response_code(400);
    echo json_encode(["error" => "please provide title for your task!"]);
    exit;
}
//TODO: sanitize data before using it
try {
    $database = new Database($config, $username, $password);
    $sql = 'INSERT INTO TASKS(title) values(:title);';
    $stmt = $database->$conn->prepare($sql);
    $stmt->execute([':title' => $title]);
    header("Location: /tasks");
    exit;
} catch (PDOException $e) {
    error_log($e->getMessage());
    echo json_encode(["error" => "ther was an error inserting your task"]);
    http_response_code(500);
}
