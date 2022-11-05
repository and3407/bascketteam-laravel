<?php

namespace App\Components\User\Services;

use App\Components\User\Models\User;
use App\Components\User\Repositories\UserRepository;
use Illuminate\Support\Facades\Hash;

class UserService
{
    private Hash $hashService;
    private UserRepository $userRepository;

    public function __construct(
        Hash $hashService,
        UserRepository $userRepository
    ) {
        $this->hashService = $hashService;
        $this->userRepository = $userRepository;
    }

    public function registerUser(
        string $name,
        string $email,
        string $password
    ): string {
        return $this->createPersonalAccessToken(
            $this->createUser($name, $email, $password)
        );
    }

    public function createUser(
        string $name,
        string $email,
        string $password
    ): User {
        return $this
            ->userRepository
            ->createUser(
                $name,
                $email,
                $this->createPasswordHash($password)
            );
    }

    public function createPersonalAccessToken(User $user): string
    {
        return $user->createToken('api_token')->plainTextToken;
    }

    private function createPasswordHash(string $password): string
    {
        return $this->hashService::make($password);
    }
}
