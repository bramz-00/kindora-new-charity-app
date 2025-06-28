<?php

namespace App\Http\Controllers\v0\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Resources\UserResource;
use App\Services\Auth\AuthService;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    protected AuthService $auth;

    public function __construct(AuthService $auth)
    {
        $this->auth = $auth;
    }

    public function register(RegisterRequest $request)
    {
        $user = $this->auth->register($request);
        return new UserResource($user);
    }

    public function login(LoginRequest $request)
    {
        $user = $this->auth->login($request);
        return new UserResource($user);
    }

    public function logout(Request $request)
    {
        $this->auth->logout($request);
        return response()->json(['message' => 'Logged out']);
    }

    public function me(Request $request)
    {
        $user = $this->auth->me($request);
        return new UserResource($user);
    }

    public function verifyEmail($id, $hash)
    {
        $this->auth->verifyEmail($id, $hash);
        return response()->json(['message' => 'Email verified']);
    }

    public function resendVerificationEmail(Request $request)
    {
        $this->auth->resendVerification($request);
        return response()->json(['message' => 'Verification link sent']);
    }

    public function forgotPassword(Request $request)
    {
        $this->auth->forgotPassword($request);
        return response()->json(['message' => 'Reset link sent']);
    }

    public function resetPassword(Request $request)
    {
        $this->auth->resetPassword($request);
        return response()->json(['message' => 'Password reset successful']);
    }

}
