<?php
use App\Http\Controllers\v0\Admin\UserController;
use App\Http\Controllers\v0\Features\GoodController;
use App\Http\Controllers\v0\Features\OrganisationController;
use Illuminate\Support\Facades\Route;


Route::middleware('auth:sanctum')->prefix("admin")->group(
    function () {

        Route::get("/", function () {
            return response()->json("It admin route");
        });






        // Users
        Route::apiResource('users', UserController::class);
        Route::prefix('users')->group(function () {


            // Bulk operations
            Route::post('/bulk-delete', [UserController::class, 'bulkDelete']); // POST /api/users/bulk-delete
            // User status management
            Route::post('/{id}/toggle-status', [UserController::class, 'toggleStatus']); // POST /api/users/{id}/toggle-status
            // Profile management
            Route::put('/{id}/profile', [UserController::class, 'updateProfile']); // PUT /api/users/{id}/profile
            Route::put('/{id}/change-password', [UserController::class, 'changePassword']); // PUT /api/users/{id}/change-password
            // Search and filtering
            Route::get('/search/query', [UserController::class, 'search']); // GET /api/users/search/query?query=...
            // Statistics
            Route::get('/stats/overview', [UserController::class, 'getStats']); // GET /api/users/stats/overview
        });


        //Organisations
        Route::apiResource('organisation', OrganisationController::class);
        Route::prefix('organisations')->group(function () {
        });


        //Goods
        Route::apiResource('good', GoodController::class);
        Route::prefix('goods')->group(function () {
        });
    }
);







