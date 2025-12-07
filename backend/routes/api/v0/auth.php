<?php
use App\Http\Controllers\v0\Admin\UserController;
use App\Http\Controllers\v0\Auth\AuthController;
use Illuminate\Support\Facades\Route;


Route::prefix("auth")->group(
    function () {

        Route::get("/", function () {
            return response()->json("It auth route");
        });
        Route::post('/register', [AuthController::class, 'register']);
        Route::post('/login', [AuthController::class, 'login']);
        Route::post('/forgot-password', [AuthController::class, 'forgotPassword']);
        Route::post('/reset-password', [AuthController::class, 'resetPassword']);
        Route::get('/email/verify/{id}/{hash}', [AuthController::class, 'verifyEmail'])->name('verification.verify');
        Route::post('/email/resend', [AuthController::class, 'resendVerificationEmail']);

        Route::middleware(['auth:sanctum'])->group(function () {
            Route::get('/me', [AuthController::class, 'me']);
            Route::post('/logout', [AuthController::class, 'logout']);
        });
    }


);