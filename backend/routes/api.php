<?php

use App\Http\Controllers\v0\Admin\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return  $request->user();
});
        // Route::put('/profile-update', [UserController::class, 'updateProfile'])->name("user.update.profile"); 

require __DIR__ .'/api/v0/index.php';