<?php

namespace Core;

use PDO;
use Core\Response;

class Database
{
    public $conn;
    public $statment;
    public function __construct($config, $username, $password)
    {
        try {
            $dsn = 'mysql:' . http_build_query($config, "", ";");
            $this-> conn = new PDO($dsn, $username, $password);
            error_log("Connected to database {$config['dbname']} at {$config['host']} successfully.");
        } catch (PDOException $pe) {
            die('Could not connecto to database' . $config['dbname'] . ": " . $pe->getMessage());
        }
    }
    public function query($sql, $params)
    {
        $stmt = $this->conn->prepare($sql);
        $stmt->execute($params);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $this->statment = $stmt;
        return $this;
    }
    public function fetch()
    {
        return  $this->statment->fetch();
    }
    public function fetchOrAbort()
    {
        $data = $this->fetch();
        if (!$data) {
            abort(Response::NOT_FOUND);
        }
        return $data;
    }
}
