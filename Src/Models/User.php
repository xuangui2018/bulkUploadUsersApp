<?php

declare(strict_types = 1);

namespace App\Models;

use App\Helpers\HumanNameFormatHelper;
use App\Database\Database;
use App\Exceptions\DatabaseConnectionException;
use Throwable;

class User {

    /**
     * @var $name
     */
    private $name;

    /**
     * @var $surname
     */
    private $surname;

    /**
     * @var $email
     */
    private $email;

    /**
     * Set name
     *
     * @param string $name
     */
    public function setName(string $name) {

        $this->name = HumanNameFormatHelper::format($name);
    }

    /**
     * Set surname
     *
     * @param string $surname
     */
    public function setSurname(string $surname) {
        $this->surname =  HumanNameFormatHelper::format($surname);
    }

    /**
     * Set email
     *
     * @param string $email
     */
    public function setEmail(string $email) {
        $this->email = trim($email);
    }

    /**
     * Get name
     *
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Get surname
     *
     * @return mixed
     */
    public function getSurname()
    {
        return $this->surname;
    }

    /**
     * Get email
     *
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Save user
     *
     * @param $databaseConnection
     * @return string
     */
    public function save($databaseConnection): string
    {
        $query = "INSERT INTO users (name, surname, email) VALUES (?, ?, ?);";
        $stmt = $databaseConnection->prepare($query);
        $stmt->bindParam(1, $this->name);
        $stmt->bindParam(2, $this->surname);
        $stmt->bindParam(3, $this->email);

        if ($stmt->execute()) {
            return "Unable to add user." . PHP_EOL;
        } else {
            return "User added successfully." . PHP_EOL;
        }
    }

    /**
     * Dry run - only print out queries
     *
     * @return void
     */
    public function dryRun(): void
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