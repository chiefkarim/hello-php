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
        //TODO:replace pdo with another connector to handle production errors properly
        try {
            $dsn = 'mysql:' . http_build_query($config, "", ";");
            $this-> conn = new PDO($dsn, $username, $password, [ PDO::ATTR_TIMEOUT => 5]);
        } catch (PDOException $pe) {
            error_log('Could not connecto to database' . $config['dbname'] . ": " . $pe->getMessage());
            abort(Response::INTERNAL_SERVER_ERROR);
        }
    }
    public function query($sql, $params = [])
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
    public function fetchAll()
    {
        return  $this->statment->fetchAll();
    }
}
