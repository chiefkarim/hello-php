<?php

require __DIR__ . '/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$config = [];


$config['host'] = $_ENV['MYSQL_HOST'];
$config['dbname'] = $_ENV['MYSQL_DBNAME'];
$config['port'] = $_ENV["MYSQL_PORT"];
$username = $_ENV['MYSQL_USERNAME'];
$password = $_ENV['MYSQL_PASSWORD'];
