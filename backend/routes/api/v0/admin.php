<?php
use App\Http\Controllers\v0\Admin\UserController;
use Illuminate\Support\Facades\Route;


Route::prefix("admin")->group(
    function () {

        Route::get("/", function () {
            return response()->json("It admin route");
        });
    }
)->middleware('auth:sanctum');







Route::prefix('users')->group(function () {
    
    // Basic CRUD operations
    Route::get('/', [UserController::class, 'index']); // GET /api/users
    Route::post('/', [UserController::class, 'store']); // POST /api/users
    Route::get('/{id}', [UserController::class, 'show']); // GET /api/users/{id}
    Route::put('/{id}', [UserController::class, 'update']); // PUT /api/users/{id}
    Route::delete('/{id}', [UserController::class, 'destroy']); // DELETE /api/users/{id}
    
    // Bulk operations
    Route::post('/bulk-delete', [UserController::class, 'bulkDelete']); // POST /api/users/bulk-delete
    Route::post('/bulk-activate', [UserController::class, 'bulkActivate']); // POST /api/users/bulk-activate
    Route::post('/bulk-deactivate', [UserController::class, 'bulkDeactivate']); // POST /api/users/bulk-deactivate
    
    // User status management
    Route::post('/{id}/activate', [UserController::class, 'activate']); // POST /api/users/{id}/activate
    Route::post('/{id}/deactivate', [UserController::class, 'deactivate']); // POST /api/users/{id}/deactivate
    Route::post('/{id}/toggle-status', [UserController::class, 'toggleStatus']); // POST /api/users/{id}/toggle-status
    
    // Profile management
    Route::put('/{id}/profile', [UserController::class, 'updateProfile']); // PUT /api/users/{id}/profile
    Route::put('/{id}/change-password', [UserController::class, 'changePassword']); // PUT /api/users/{id}/change-password
    
    // Search and filtering
    Route::get('/search/query', [UserController::class, 'search']); // GET /api/users/search/query?query=...
    Route::get('/active/list', [UserController::class, 'getActiveUsers']); // GET /api/users/active/list
    Route::get('/inactive/list', [UserController::class, 'getInactiveUsers']); // GET /api/users/inactive/list
    
    // Statistics
    Route::get('/stats/overview', [UserController::class, 'getStats']); // GET /api/users/stats/overview
});