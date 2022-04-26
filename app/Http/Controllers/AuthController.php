<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    /**
     * Create a user via credentials.
     * 
     * @param  RegisterRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function register(RegisterRequest $request)
    {
        $credentials = $request->validated();
        $user = User::create($credentials);

        $user->token = $user->createToken("Application Token requestted from: " . $request->header('User-Agent', 'Vue App'))->plainTextToken;

        return response()->json($user, 201);
    }
    /**
     * Log the user in.
     * 
     * @param  LoginRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function login(LoginRequest $request)
    {
        $credentials = $request->validated();

        $user = User::where('email', $credentials['email'])->first();

        if (!$user || !Hash::check($credentials['password'], $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        $user->token = $user->createToken("Application Token requested from: " . $request->header('User-Agent', 'Vue App'))->plainTextToken;

        return response()->json($user);
    }

    /**
     * Log the user out.
     * 
     * @param  Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json("User Succesfully Logged Out!", 200);
    }
}
