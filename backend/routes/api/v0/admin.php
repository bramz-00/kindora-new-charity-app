<?php
use Illuminate\Support\Facades\Route;


Route::prefix("admin")->group(
    function () {

        Route::get("/", function () {
            return response()->json("It admin route");
        });
    }
)->middleware('auth:sanctum');