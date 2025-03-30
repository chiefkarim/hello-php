<?php

require_once 'connect.php';

try {
    $sql = "SELECT * FROM TASKS LIMIT 10;";
    $stmt = $conn->query($sql);
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $rows = $stmt->fetchAll();

    $tasks = array_map(
        fn ($row) => [
        "title" => $row['title'],
        "completed" => (bool)$row['completed']
        ],
        $rows
    );
    include 'select.view.php';
} catch (PDOException $e) {
    die($e->getMessage());
}
?>

