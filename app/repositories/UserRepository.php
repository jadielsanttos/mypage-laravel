<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository
{

    public static function findByID(int $userID): object
    {
        $getUser = User::where('id', $userID)->first();

        return $getUser;
    }

}
