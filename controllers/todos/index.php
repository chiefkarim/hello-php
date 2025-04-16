<?php

use Core\App;

try {

    $database = App::resolve(\Core\Database::class);
    $sql = "SELECT * FROM TASKS  WHERE user_id = :user_id LIMIT 10;";
    $stmt = $database->query($sql, ["user_id" => 2]);
    $rows = $stmt -> fetchAll();

    $todos = array_map(
        fn ($row) => [
        "title" => (string) $row['title'],
        "completed" => (bool) $row['completed'],
        "id" => (int) $row['id'],
        ],
        $rows
    );
    view('todos/index.view.php', ['todos' => $todos,"errors" => $errors ?? []]);
} catch (PDOExcepton $e) {
    error_log("error while getting taks! " . $e);
    die($e->getMessage());
}
?>

