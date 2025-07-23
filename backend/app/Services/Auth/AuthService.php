<?php

namespace App\Services\Auth;

use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;



class AuthService
{

    public function register(RegisterRequest $request): User
    {
        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);
        $user->token = $user->createToken('access_token')->plainTextToken;
        $user->sendEmailVerificationNotification();
        return $user;
    }


    public function login(LoginRequest $request): ?User
    {
        $credentials = $request->only('email', 'password');

        if (!Auth::attempt($credentials)) {
            return null; // Let the controller handle the response
        }

        $request->session()->regenerate();

        return Auth::user();
    }


    public function logout(Request $request): void
    {
        $guard = Auth::guard();

        if (method_exists($guard, 'logout')) {
            $guard->logout();
        }

        $request->session()->invalidate();
        $request->session()->regenerateToken();
    }

    public function me(Request $request): User
    {
        return $request->user();
    }

    public function verifyEmail($id, $hash): void
    {
        $user = User::findOrFail($id);

        if (!hash_equals((string) $hash, sha1($user->getEmailForVerification()))) {
            abort(403, 'Invalid verification link');
        }

        if (!$user->hasVerifiedEmail()) {
            $user->markEmailAsVerified();
        }
    }

    public function resendVerification(Request $request): void
    {
        if (!$request->user()->hasVerifiedEmail()) {
            $request->user()->sendEmailVerificationNotification();
        }
    }

    public function forgotPassword(Request $request): void
    {
        $request->validate(['email' => 'required|email']);
        Password::sendResetLink($request->only('email'));
    }

    public function resetPassword(Request $request): void
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:8',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (User $user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password),
                    'remember_token' => Str::random(60),
                ])->save();

                event(new PasswordReset($user));
            }
        );

        if ($status !== Password::PASSWORD_RESET) {
            abort(400, 'Reset failed');
        }
    }
}
