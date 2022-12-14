<?php

namespace App\Components\Users\Services;

use App\Models\User;
use App\Components\Users\Repositories\UsersRepository;
use Illuminate\Support\Facades\Hash;

class UsersService
{
    private const API_TOKEN_NAME = 'api_token';

    private UsersRepository $userRepository;

    public function __construct(
        UsersRepository $userRepository
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
        return $user->createToken(self::API_TOKEN_NAME)->plainTextToken;
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
