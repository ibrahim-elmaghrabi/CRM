<?php

namespace App\Services\Api;

use App\Models\User;
use App\Events\UserCreation;
use Illuminate\Support\Facades\Hash;
use App\Repositories\Eloquent\UserRepository;
 
class UserService
{
    private UserRepository $userRepository;

    const TOKEN_NAME = 'personal';

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository ;
    }
    public function store($request)
    {
        $user= $this->userRepository->store($request);
        $token = $user->createToken(self::TOKEN_NAME)->plainTextToken;
        event(new UserCreation($user));
        return httpResponse(1, "Success", ['token'=> $token]);
    }

    public function login($request)
    {
        $user = $this->userRepository->firstWhere('email', $request['email']);
        if (!$user || !Hash::check($request['password'], $user->password))
        {
            return httpResponse(0, 'Wrong Credentials');
        }
        $token = $user->createToken(self::TOKEN_NAME)->plainTextToken;
        return httpResponse(1, "Success",['token'=> $token]) ;
    }

}