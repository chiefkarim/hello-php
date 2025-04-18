<?php

use Core\App;
use Core\Response;
use Core\Validator;

$title = trim(htmlspecialchars($_POST["title"])) ?? null;

$errors = [];

if (!Validator::string($title, 1, 50)) {
    $errors[] = "Please provide title for your task with length between 1 and 50 characters!";
}

if (empty($errors)) {

    try {
        $database = App::resolve(\Core\Database::class);
        $sql = 'INSERT INTO TASKS(title,user_id) values(:title,:user_id);';
        $id = $_SESSION['user']['id'];
        $stmt = $database->query($sql, [':title' => $title,":user_id" => $id ]);
        redirect("/todos");
    } catch (PDOException $e) {
        error_log($e->getMessage());
        abort(Response::INTERNAL_SERVER_ERROR);
    }
}

// if success redirect
controller("todos/index.php", []);
