<?php

declare(strict_types=1);

namespace App\Validations;

use App\Models\User;

class UserValidation
{
    /**
     * Validate user data
     *
     * @param User $user
     * @return array
     */
    public static function validate(User $user): array
    {
        $errorMesassage = [];
        if ($user->getName() === '') {
            $errorMesassage[] = 'Name is required';
        }
        if ($user->getSurname() === '') {
            $errorMesassage[] = 'Surname is required';
        }
        if ($user->getEmail() === '') {
            $errorMesassage[] = 'Email is required';
        }
        if (strlen($user->getName()) > 100 || strlen($user->getName()) < 2) {
            $errorMesassage[] = 'Name has to be more than 1 character and less than 100 characters';
        }
        if (strlen($user->getSurname()) > 100 || strlen($user->getSurname()) < 2) {
            $errorMesassage[] = 'Surname has to be more than 1 character and less than 100 characters';
        }
        if (!preg_match("/^([a-zA-Z' ]+)$/", $user->getName())) {
            $errorMesassage[] = 'Name is not valid: ' . $user->getName();
        }
        if (!preg_match("/^([a-zA-Z' ]+)$/", $user->getSurname())) {
            $errorMesassage[] = 'Surname is not valid: '. $user->getSurname();
        }
        if (strlen($user->getEmail()) > 200) {
            $errorMesassage[] = 'Email has to be less than 200 characters';
        }
        if (!filter_var($user->getEmail(), FILTER_VALIDATE_EMAIL)) {
            $errorMesassage[] = 'Email is not valid: '. $user->getEmail();
        }
        return $errorMesassage;
    }
}


