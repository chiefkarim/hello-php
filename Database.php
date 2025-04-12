<?php

class Database
{
    public $conn;
    public function __construct($config, $username, $password)
    {
        try {
            $dsn = 'mysql:' . http_build_query($config, "", ";");
            $this-> $conn = new PDO($dsn, $username, $password);
            error_log("Connected to database {$config['dbname']} at {$config['host']} successfully.");
        } catch (PDOException $pe) {
            die('Could not connecto to database $dbname :' . $pe->getMessage());
        }
    }
}
