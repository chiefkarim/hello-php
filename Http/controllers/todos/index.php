<?php

use Core\App;

try {
    $database = App::resolve(\Core\Database::class);
    $sql = "SELECT * FROM TASKS  WHERE user_id = :user_id LIMIT 10;";
    $id = $_SESSION['user']['id'];
    $stmt = $database->query($sql, ["user_id" => $id]);
    $rows = $stmt -> fetchAll();

    $todos = array_map(
        fn ($row) => [
        "title" => (string) $row['title'],
        "completed" => (bool) $row['completed'],
        "id" => (int) $row['id'],
        ],
        $rows
    );
    view('todos/index.view.php', ['todos' => $todos,"errors" => []]);
} catch (PDOExcepton $e) {
    error_log($e->getMessage());
    abort(Response::INTERNEL_SERVER_ERROR);
    exit;
}
?>

