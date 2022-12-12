<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     *
     * @throws AuthenticationException
     */
    public function login(LoginRequest $request): \Illuminate\Http\JsonResponse
    {
        if (!auth()->attempt($request->only('email', 'password'))) {
            throw new AuthenticationException("Email or password is not valid");
        }
        $token = auth()->user()->createToken('user-token');
        return response()->json([
            'message' => 'successfully logged in',
            'token'   => $token->plainTextToken
        ], 200);
    }

    /**
     * @param StoreUserRequest $request
     * @return mixed
     */
    public function register(StoreUserRequest $request)
    {
        $payload = $request->validated();
        $payload['password'] = Hash::make($payload['password']);
        return response()->json(User::create($payload));
    }

    /**
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    public function me()
    {
        return auth()->user();
    }

    /**
     * @return string[]
     */
    public function logout(): array
    {
        auth()->user()->currentAccessToken()->delete();
        return [
            'message' => 'Successfully Logged out'
        ];
    }
}
