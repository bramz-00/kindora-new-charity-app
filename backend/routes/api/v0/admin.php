<?php

use App\Http\Controllers\v0\Admin\UserController;
use App\Http\Controllers\v0\Features\EventController;
use App\Http\Controllers\v0\Features\GoodController;
use App\Http\Controllers\v0\Features\GoodProposalController;
use App\Http\Controllers\v0\Features\JackpotController;
use App\Http\Controllers\v0\Features\OrganisationController;
use App\Http\Controllers\v0\Features\ReviewController;
use App\Http\Controllers\v0\Features\VolunteerOpportunityController;
use Illuminate\Support\Facades\Route;


Route::prefix("admin")->group(
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
           Route::put('/profile/update', [UserController::class, 'updateProfile'])->name("user.update.profile"); 

            Route::put('/{id}/change-password', [UserController::class, 'changePassword']); // PUT /api/users/{id}/change-password
            // Search and filtering
            Route::get('/search/query', [UserController::class, 'search']); // GET /api/users/search/query?query=...
            // Statistics
            Route::get('/stats/overview', [UserController::class, 'getStats']); // GET /api/users/stats/overview
        });


        //Organisations
        Route::apiResource('organisation', OrganisationController::class);
        Route::prefix('organisations')->group(function () {});


        //Goods
        Route::apiResource('good', GoodController::class)->except(['index'])->middleware('auth:sanctum');
        Route::get('good', [GoodController::class,'index']);

        Route::prefix('goods')->group(function () {});
        //Good Proposals
        Route::apiResource('good_proposal', GoodProposalController::class);

        Route::prefix('good_proposals')->group(function () {
            Route::post('/reject/{id}', [GoodProposalController::class, 'rejectGoodProposal'])->name('good_proposals.reject');
            Route::post('/validate/{id}', [GoodProposalController::class, 'validateGoodProposal'])->name('good_proposals.validate');
        });
        //Events

        Route::apiResource('event', EventController::class);
        Route::prefix('events')->group(function () {});
        Route::apiResource('event_order', EventController::class);
        Route::prefix('event_orders')->group(function () {});
        Route::apiResource('event_ticket', EventController::class);
        Route::prefix('event_tickets')->group(function () {});
        //Jackpots
        Route::apiResource('jackpot', JackpotController::class);
        Route::prefix('jackpots')->group(function () {});
        Route::apiResource('jackpot_contribution', JackpotController::class);
        Route::prefix('jackpot_contributions')->group(function () {});
        //Volunteer_Opportunities
        Route::apiResource('volunteer_opportunity', VolunteerOpportunityController::class);
        Route::prefix('volunteer_opportunities')->group(function () {});
        Route::apiResource('volunteer_application', VolunteerOpportunityController::class);
        Route::prefix('volunteer_applications')->group(function () {});



        Route::apiResource('review', ReviewController::class);
        Route::prefix('reviews')->group(function () {});
    }
);
