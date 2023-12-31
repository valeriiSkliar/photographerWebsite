<?php

use App\Http\Controllers\Admin\Page\PageController;
use App\Http\Controllers\API\LangSwitcherController;
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


Route::post('/set-lang', [LangSwitcherController::class, 'setLangInCookies']);

Route::apiResource('/meta-tags', MetaTagController::class);
Route::post('/get-meta-list-markup', [MetaTagController::class, 'getMarkUp']);
Route::post('/meta-tags-group', [MetaTagController::class, 'updateMetaTagsGroup']);
Route::post('/meta-tags-add-{type}', [MetaTagController::class, 'addNewRow']);

Route::group([], function () {
    Route::delete('/un-pin', [\App\Http\Controllers\Admin\AlbumsController::class, 'unPinImage']);
    Route::delete('/component-detail/{id}', [App\Http\Controllers\API\ComponentDetailController::class, 'destroy']);
    Route::get('/get-detail-row-template', [App\Http\Controllers\API\ComponentDetailController::class, 'getDetailRowTemplate']);
    Route::post('/component-form/{id}', [App\Http\Controllers\API\ComponentDetailController::class, 'attach_form']);
    Route::post('/component-album/{id}', [App\Http\Controllers\API\ComponentDetailController::class, 'change_album']);
    Route::post('/component-album-disconnect/{id}', [App\Http\Controllers\API\ComponentDetailController::class, 'album_disconnect']);
    Route::get('/component-get-current-album/{name}', [App\Http\Controllers\API\ComponentDetailController::class, 'getCurrentAlbum']);
    Route::post('/update-components-list/order', [App\Http\Controllers\API\ComponentDetailController::class, 'updateOrder']);
    Route::post('/page/{pageId}/addComponent', [PageController::class, 'attachComponent']);
    Route::post('/page/{pageId}/removeComponent', [PageController::class, 'detachComponent']);
    Route::get('/{pageId}/get-all-components-markup', [PageController::class, 'updateAllComponentsList']);
});
