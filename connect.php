<?php

require_once "./config.php";


class Database
{
    public $conn;
    public function __construct()
    {
        try {
            global $host, $dbname, $username, $password;
            $this-> $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
            error_log("Connected to database $dbname at $host successfully.");
        } catch (PDOException $pe) {
            die('Could not connecto to database $dbname :' . $pe->getMessage());
        }
    }
}
