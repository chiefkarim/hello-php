<?php

require_once base_path('connect.php');

$sql = 'CREATE TABLE IF NOT EXISTS TASKS(
id INT AUTO_INCREMENT PRIMARY KEY,
title VARCHAR(255) NOT NULL,
completed BOOL DEFAULT false);';

try {
    $conn->exec($sql);
    echo "Table tasks created successfully!";
} catch (PDOException $e) {
    die($e->getMessage());
}
