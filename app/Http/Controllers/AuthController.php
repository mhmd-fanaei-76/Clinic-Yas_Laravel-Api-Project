<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function register(RegisterRequest $request)
    {
        $user = User::query()->create($request->validated());
        $user->assignRole('patient');
        $token = $user->createToken('auth');
        return response()->json([
            "user" => $user,
            "token" => $token->plainTextToken,
            "message" => "user created"
        ]);
    }

    public function login(LoginRequest $request)
    {
//        return Hash::make('123');
        if(\auth()->attempt($request->validated())) {
            $token = auth()->user()->createToken('auth');
            return  response()->json([
                "user" => auth()->user(),
                "token" => $token->plainTextToken
            ]);
        }
        return response()->json([
            "message" => "wrong email or password"
        ],401);
    }

    public function logout()
    {
        auth()->user()->currentAccessToken()->delete();
        return response()->json([
            "message" => "you are logout"
        ]);
    }
}
