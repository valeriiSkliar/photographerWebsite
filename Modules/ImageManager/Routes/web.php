<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Modules\ImageManager\Http\Controllers\ImageManagerController;

Route::prefix('admin')->group(function() {
    Route::resource('/imagemanager', ImageManagerController::class);
    Route::post('/imagemanager/create-album', 'ImageManagerController@createAlbum')->name('create_album');
    Route::post('/imagemanager/save-album/{album}', 'ImageManagerController@saveAlbum')->name('save_album');
});
