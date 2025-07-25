<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\User\CapsuleController;
use App\Http\Controllers\User\MediaController;
use App\Http\Controllers\AuthController;

Route::group(["prefix" => "v0.1"], function () {

    Route::group(["middleware" => "auth:api"], function () {
        Route::group(["prefix" => "user"], function () {
            Route::get('/capsules/{id?}', [CapsuleController::class, "getAllCapsules"]);
            Route::get('/revealed_capsules/{id?}', [CapsuleController::class, "getRevealedCapsules"]);
            Route::get('/closed_capsules/{id?}', [CapsuleController::class, "getClosedCapsules"]);
            Route::get('/get_by_emoji/{emoji?}', [CapsuleController::class, "getByEmoji"]);
            Route::post('/add_update_capsule/{id?}', [CapsuleController::class, "addOrUpdateCapsule"]);

            Route::get('/media/{id?}', [MediaController::class, "getAllMedia"]);
            Route::get("/get_media_by_capsule_id/{id}", [MediaController::class, "getAllMediaByCapsuleId"]);
            Route::post('/add_update_media/{id?}', [MediaController::class, "addOrUpdateMedia"]);
        });
    });

    //UNAUTHENTICATED APIs
    Route::group(["prefix" => "guest"], function () {
        Route::post("/login", [AuthController::class, "login"]);
        Route::post("/register", [AuthController::class, "register"]);
    });
});
