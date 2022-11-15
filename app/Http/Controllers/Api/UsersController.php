<?php

namespace App\Http\Controllers\Api;

use App\Components\Users\Services\UsersService;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    private UsersService $userService;

    public function __construct(UsersService $userService)
    {
        $this->userService = $userService;
    }

    public function register(Request $request): JsonResponse
    {
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users|max:255',
            'password' => 'required|max:255',
        ]);

        $name = $request->input('name');
        $email = $request->input('email');
        $password = $request->input('password');
        $token = $this->userService->registerUser($name, $email, $password);

        return $this
            ->apiResponse()
            ->setData(['token' => $token])
            ->json();
    }

    public function getToken(): JsonResponse
    {
        $user = $this->getAuthUser();
        $this->userService->removeApiTokens($user);
        $token = $this->userService->createPersonalAccessToken($user);

        return $this
            ->apiResponse()
            ->setData(['token' => $token])
            ->json();
    }

    public function getName(): JsonResponse
    {
        $user = $this->getAuthUser();

        return $this
            ->apiResponse()
            ->setData(['name' => $user->name])
            ->json();

    }
}
