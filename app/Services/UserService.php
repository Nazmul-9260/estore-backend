<?php

namespace App\Services;

use App\Models\User;

class UserService
{

    public function getUsersByName($name)
    {
        $users = User::query()->where('name', 'like', '%' . $name . '%')->paginate(5);
        return $users;
    }

    public function getUsersByEmail($email)
    {
        $users = User::query()->where('email', 'like', '%' . $email . '%')->paginate(5);
        return $users;
    }
}
