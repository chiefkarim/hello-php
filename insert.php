<?php

require_once 'Database.php';
require_once 'config.php';
require_once 'Response.php';
// Read JSON input

$title = trim(htmlspecialchars($_POST["title"])) ?? null;
//Debugging logs
error_log("Raw JSON data: $title");

$errors = [];

if (!$title and strlen($title) === 0) {
    $errors[] = "Please provide title for your task!";
}

if (strlen($title) > 255) {
    $errors[] = "Please provide less than 255 char title!";
}

if (empty($errors)) {

    try {
        $database = new Database($config, $username, $password);
        $sql = 'INSERT INTO TASKS(title,user_id) values(:title,:user_id);';
        $stmt = $database->conn->prepare($sql);
        $stmt->execute([':title' => $title,":user_id" => 2]);
        header("Location: /tasks");
        exit;
    } catch (PDOException $e) {
        error_log($e->getMessage());
        echo json_encode(["error" => "ther was an error inserting your task"]);
        http_response_code(Response::INTERNEL_SERVER - ERROR);
        exit;
    }
} else {
    include "controllers/select.php";
}
