<?php

namespace App\Components\User\Services;

use App\Models\User;
use App\Components\User\Repositories\UserRepository;
use Illuminate\Support\Facades\Hash;

class UserService
{
    private UserRepository $userRepository;

    public function __construct(
        UserRepository $userRepository
    ) {
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
                $this->getPasswordHash($password)
            );
    }

    public function createPersonalAccessToken(User $user): string
    {
        return $user->createToken('api_token')->plainTextToken;
    }

    private function getPasswordHash(string $password): string
    {
        return Hash::make($password);
    }

    public function removeApiTokens(User $user): int
    {
        return $user->tokens()->delete();
    }
}
