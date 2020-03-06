<?php

namespace App\Database;

use App\Exceptions\DatabaseConnectionException;
use PDO;
use Throwable;

class Database {
    private $dbHost = 'localhost';
    private $dbName = '';
    private $dbUsername = 'root';
    private $dbPassword = '';
    private $connection;

    public function __construct($dbHost = '', $dbUsername = '', $dbPassword = '', $dbName = '') {
        if ($dbHost) {
            $this->dbHost = $dbHost;
        }
        if ($dbUsername) {
            $this->dbUsername = $dbUsername;
        }
        if ($dbPassword) {
            $this->dbPassword = $dbPassword;
        }
        if ($dbName) {
            $this->dbName = $dbName;
        }
    }

    public function getConnection() {
        $this->connection = null;
        try {
            $this->connection = new PDO('mysql:host=' . $this->dbHost . ';dbname=' . $this->dbName, $this->dbUsername, $this->dbPassword);
            $this->connection->exec('set names utf8');
        } catch (Throwable $exception) {
            throw new DatabaseConnectionException('Database connection error. dbHost: '. $this->dbHost . ', dbName: ' . $this->dbName . ', dbUsername: '. $this->dbUsername . ', dbPassword: '. $this->dbPassword);
        }
        return $this->connection;
    }
}