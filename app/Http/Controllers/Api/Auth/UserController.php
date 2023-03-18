<?php

namespace App\Http\Controllers\Api\Auth;

use App\Services\Api\UserService;
use App\Http\Requests\UserRequest;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    private UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function store(UserRequest $request)
    {
        return $this->userService->store($request->validated());
    }
}
