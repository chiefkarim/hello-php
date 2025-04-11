<?php

require_once 'connect.php';

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
    $sql = 'INSERT INTO TASKS(title) values(:title);';
    $stmt = $conn->prepare($sql);
    $stmt->execute([':title' => $title]);
    header("Location: /select.php");
    exit;
} catch (PDOException $e) {
    error_log($e->getMessage());
    echo json_encode(["error" => "ther was an error inserting your task"]);
    http_response_code(500);
}
