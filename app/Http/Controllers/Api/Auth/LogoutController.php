<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LogoutController extends Controller
{
    public function logout()
    {
        request()->user()->tokens()->delete();
        return httpResponse(1, "Logged out");
    }
}
