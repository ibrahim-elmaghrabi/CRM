<?php

namespace App\Http\Controllers\Api\Auth;

use App\Services\Api\UserService;
use App\Http\Requests\LoginRequest;
use App\Http\Controllers\Controller;

class LoginController extends Controller
{
    private UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function login(LoginRequest $request)
    {
       return $this->userService->login($request->validated());
    }
}
