<?php

namespace App\Database;

use PDO;

class Database {
    private $dbHost = 'localhost';
    private $dbName = 'bulkUploadUsersApp';
    private $dbUsername = 'root';
    private $dbPassword = '';
    private $connection;

    public function __construct($dbHost = '', $dbName = '', $dbPassword = '') {
        $this->dbHost = $dbHost;
        $this->dbName = $dbName;
        $this->dbPassword = $dbPassword;
    }

    public function getConnection() {
        $this->connection = null;
        $this->connection = new PDO('mysql:host=' . $this->dbHost . ';dbname=' . $this->dbName, $this->dbUsername, $this->dbPassword);
        $this->connection->exec('set names utf8');
        return $this->connection;
    }
}