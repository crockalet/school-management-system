<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\Request;

/**
 * @tags Auth
 */
class LoginController extends Controller
{
    /**
     * Login
     */
    public function __invoke(LoginRequest $request)
    {
        $credentials = $request->validated();

        if (auth()->attempt($credentials)) {
            return [
                'message' => 'Login Successful',
                'token' => auth()->user()->createToken('auth_token')->plainTextToken,
            ];
        }

        throw \Illuminate\Validation\ValidationException::withMessages([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }
}
