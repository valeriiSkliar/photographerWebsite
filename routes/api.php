<?php

use App\Http\Controllers\API\MetaTagController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::group([], function () {
    Route::apiResource('/meta-tags', MetaTagController::class);
    Route::delete('/component-detail/{id}', [App\Http\Controllers\API\ComponentDetailController::class, 'destroy']);
    Route::post('/component-album/{id}', [App\Http\Controllers\API\ComponentDetailController::class, 'change_album']);
});
