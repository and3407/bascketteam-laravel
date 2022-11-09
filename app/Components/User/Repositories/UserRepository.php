<?php

namespace App\Components\User\Repositories;

use App\Models\User;

class UserRepository
{
    public function createUser(
        string $name,
        string $email,
        string $password
    ): User {
        return User::create([
            'name' => $name,
            'email' => $email,
            'password' => $password,
        ]);
    }
}
