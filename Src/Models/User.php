<?php

declare(strict_types = 1);

namespace App\Models;

use App\Helpers\HumanNameFormatHelper;
use App\Database\Database;
use App\Exceptions\DatabaseConnectionException;
use Throwable;

class User {

    private $name;
    private $surname;
    private $email;

    public function setName(string $name) {

        $this->name = HumanNameFormatHelper::format($name);
    }

    public function setSurname(string $surname) {
        $this->surname =  HumanNameFormatHelper::format($surname);
    }

    public function setEmail(string $email) {
        $this->email = trim($email);
    }

    public function getName()
    {
        return $this->name;
    }

    public function getSurname()
    {
        return $this->surname;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function save()
    {
        $query = "INSERT INTO users (name, surname, email) VALUES (?, ?, ?);";

        try {
            $database = new Database();
            $databaseConnection = $database->getConnection();
            $stmt = $databaseConnection->prepare($query);
            $stmt->bindParam(1, $this->name);
            $stmt->bindParam(2, $this->surname);
            $stmt->bindParam(3, $this->email);

            if ($stmt->execute()) {
                return "Unable to add user." . PHP_EOL;
            } else {
                return "User added successfully." . PHP_EOL;
            }
        } catch (Throwable $e) {
            throw new DatabaseConnectionException('Unable to connect to database.');
        }
    }

    public function dryRun()
    {
        $query = sprintf(
            "INSERT INTO users (name, surname, email) VALUES ('%s', '%s', '%s')",
            addslashes($this->name),
            addslashes($this->surname),
            $this->email
        );
        print $query . PHP_EOL;
    }
}