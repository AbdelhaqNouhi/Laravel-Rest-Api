<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\V1\AlbumController;
use App\Http\Controllers\V1\ImageManipulationController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->group(function () {


    Route::prefix('v1')->group(function () {
        // album routes
        Route::apiResource('album', AlbumController::class);
        // image manipulation routes
        Route::get('image', [ImageManipulationController::class, 'index']);
        Route::get('image/{image}', [ImageManipulationController::class, 'show']);
        Route::get('image/by-album/{album}', [ImageManipulationController::class, 'byAlbum']);
        Route::delete('image/{image}', [ImageManipulationController::class, 'destroy']);
        Route::post('image/resize', [ImageManipulationController::class, 'resize']);
    });
});

