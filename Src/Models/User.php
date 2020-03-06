<?php

declare(strict_types = 1);

namespace App\Models;

use App\Helpers\HumanNameFormatHelper;

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
        $sql = sprintf(
            "INSERT INTO users (name, surname, email) VALUES ('%s', '%s', '%s')",
            $this->name,
            $this->surname,
            $this->email
        );
        print $sql. PHP_EOL;
    }

    public function dryRun()
    {
        $sql = sprintf(
            "INSERT INTO users (name, surname, email) VALUES ('%s', '%s', '%s')",
            $this->name,
            $this->surname,
            $this->email
        );
        print $sql. PHP_EOL;
    }
}