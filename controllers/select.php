<?php

require_once 'Database.php';
require_once "config.php";

try {
    $database = new Database($config, $username, $password);
    $sql = "SELECT * FROM TASKS LIMIT 10;";
    $stmt = $database->$conn->query($sql);
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $rows = $stmt -> fetchAll();

    $tasks = array_map(
        fn ($row) => [
        "title" => (string) $row['title'],
        "completed" => (bool) $row['completed'],
        "id" => (int) $row['id'],
        ],
        $rows
    );
    include 'views/select.view.php';
} catch (PDOExcepton $e) {
    error_log("error while getting taks! " . $e);
    die($e->getMessage());
}
?>

