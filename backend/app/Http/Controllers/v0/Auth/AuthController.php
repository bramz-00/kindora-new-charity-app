<?php

namespace App\Http\Controllers\v0\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Resources\UserResource;
use App\Services\Auth\AuthService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;


class AuthController extends Controller
{


    public function __construct(protected AuthService $authService)
    {
    }



    public function register(RegisterRequest $request)
    {
        $data = $request->validated();

        // $studentRole = Role::where('name', 'student')->first();
        // $data['roles'] = [$studentRole->id];
        $user = $this->authService->register($data);

        Auth::login($user);
        $request->session()->regenerate();

        return response()->json([
            'message' => 'Registration successful',
            'user' => new UserResource($user)
        ], 201);
    
    }

    public function login(LoginRequest $request)
    {
        $credentials = $request->validated();

        if (!Auth::attempt($credentials)) {
            throw ValidationException::withMessages([
                'password' => ['The provided credentials are incorrect.'],
            ]);
        }

        $request->session()->regenerate();
        $user = Auth::user();

        return new UserResource($user);
    }

    public function logout(Request $request)
    {
        $this->authService->logout($request);
        return response()->json(['message' => 'Logged out']);
    }


    public function me(Request $request)
    {
        $user = $this->authService->me($request);
        return new UserResource($user);
    }

    public function verifyEmail($id, $hash)
    {
        $this->authService->verifyEmail($id, $hash);
        return response()->json(['message' => 'Email verified']);
    }

    public function resendVerificationEmail(Request $request)
    {
        $this->authService->resendVerification($request);
        return response()->json(['message' => 'Verification link sent']);
    }

    public function forgotPassword(Request $request)
    {
        $this->authService->forgotPassword($request);
        return response()->json(['message' => 'Reset link sent']);
    }

    public function resetPassword(Request $request)
    {
        $this->authService->resetPassword($request);
        return response()->json(['message' => 'Password reset successful']);
    }
}
