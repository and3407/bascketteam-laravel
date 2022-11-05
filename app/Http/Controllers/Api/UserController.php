<?php

namespace App\Http\Controllers\Api;

use App\Components\User\Services\UserService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserController extends Controller
{
    private UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function register(Request $request)
    {
        $name = $request->input('name');
        $email = $request->input('email');
        $password = $request->input('password');
        $token = $this->userService->registerUser($name, $email, $password);

        return response(['token' => $token], 200);
    }
}
