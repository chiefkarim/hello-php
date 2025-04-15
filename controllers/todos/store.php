<?php

use Core\Database;
use Core\Response;
use Core\Validator;

require_once base_path('config.php');

$title = trim(htmlspecialchars($_POST["title"])) ?? null;

error_log("Raw JSON data: $title");

$errors = [];

if (!Validator::string($title, 1, 50)) {
    $errors[] = "Please provide title for your task with length between 1 and 50 characters!";
}

if (empty($errors)) {

    try {
        $database = new Database($config, $username, $password);
        $sql = 'INSERT INTO TASKS(title,user_id) values(:title,:user_id);';
        $stmt = $database->conn->prepare($sql);
        $stmt->execute([':title' => $title,":user_id" => 2]);
        header("Location: /todos");
        exit;
    } catch (PDOException $e) {
        error_log($e->getMessage());
        echo json_encode(["error" => "ther was an error inserting your task"]);
        http_response_code(Response::INTERNEL_SERVER - ERROR);
        exit;
    }
} else {
    include base_path("controllers/todos/index.php");
}
