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
     * @OA\Post(
     *      path="/api/register",
     *      tags={"Authentication"},
     *      operationId="register",
     *      @OA\Parameter(
     *          name="name",
     *          in="query",
     *          required=true,
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="email",
     *          in="query",
     *          required=true,
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="password",
     *          in="query",
     *          required=true,
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="password_confirmation",
     *          in="query",
     *          required=true,
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Response(
     *          response=201,
     *          description="Success"
     *      )
     * )
     *
     * Register new user via given credentials.
     *
     * @param RegisterRequest $request
     * @return void
     */
    public function register(RegisterRequest $request)
    {
        $credentials = $request->validated();
        $user = User::create($credentials);

        $user->token = $user->createToken("Application Token requestted from: " . $request->header('User-Agent', 'Vue App'))->plainTextToken;

        return response()->json($user, 201);
    }
    /**
     * @OA\Post(
     *      path="/api/login",
     *      tags={"Authentication"},
     *      operationId="login",
     *      @OA\Parameter(
     *          name="email",
     *          in="query",
     *          required=true,
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="password",
     *          in="query",
     *          required=true,
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Success"
     *      )
     * )
     *
     * Logs user into the system.
     *
     * @param LoginRequest $request
     * @return void
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
     * @OA\Post(
     *     path="/api/logout",
     *      tags={"Authentication"},
     *     operationId="logout",
     *     @OA\Response(
     *         response=200,
     *         description="Success"
     *     ),
     *     security={
     *         {"bearer": {}}
     *     }
     * )
     *
     * Logs out current logged in user session.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json("User Succesfully Logged Out!", 200);
    }
}
