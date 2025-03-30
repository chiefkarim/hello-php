<?php

require_once 'connect.php';
try {
    $sql = 'INSERT INTO TASKS(title) values(:title);';
    $stmt = $conn->prepare($sql);
    $stmt->execute([':title' => "clear the room."]);
    echo "added clear your room to tasks"';
} catch (PDOException $e) {
  die($e->getMessage());
}
