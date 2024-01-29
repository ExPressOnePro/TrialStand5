<?php

namespace App\Services;

use App\Models\User;

class UserService
{
    public static function getUserNameById($userId)
    {
        $user = User::find($userId);
        if ($user) {
            return $user->last_name . ' ' . $user->first_name;
        }
        return null;
    }
}
