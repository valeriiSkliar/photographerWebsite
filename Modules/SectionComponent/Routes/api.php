<?php

use Illuminate\Http\Request;
use Modules\SectionComponent\Http\Controllers\ComponentDataController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/sectioncomponent', function (Request $request) {
    return $request->user();
});
Route::apiResource('/component-data', ComponentDataController::class);
