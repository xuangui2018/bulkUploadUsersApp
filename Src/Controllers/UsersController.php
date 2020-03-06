<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Models\User;
use App\Validations\UserValidation;

class UsersController
{
    /**
     * Store users
     *
     * @param array $userDetails
     * @param bool $dryRun
     * @return array
     */
    public function store(array $userDetails, bool $dryRun)
    {
        $user = new User;
        $user->setName($userDetails[0]);
        $user->setSurname($userDetails[1]);
        $user->setEmail($userDetails[2]);

        $errorMessage = UserValidation::validate($user);
        if (!empty($errorMessage)) {
            return $errorMessage;
        } else {
            if ($dryRun) {
                $user->dryRun();
            } else {
                return $user->save();
            }
        }
    }
}