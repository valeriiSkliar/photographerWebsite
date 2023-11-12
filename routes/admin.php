<?php

use App\Http\Controllers\Admin\AdminPanelController;
use App\Http\Controllers\Admin\AlbumsController;
use App\Http\Controllers\Admin\ApplicationSubmitController;
use App\Http\Controllers\Admin\Component\ComponentController;
use App\Http\Controllers\Admin\Page\PageController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\IframeController;
use App\Http\Controllers\ImageController;

Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {
    Route::get('/', [AdminPanelController::class, '__invoke'])->name('index.dashboard');
    Route::get('/iframe-content', [IframeController::class, 'show'])->name('iframe.content');

    Route::resource('forms', FormController::class);
    Route::get('/gallery', [GalleryController::class, 'index'])->name('gallery.index');
    Route::resource('/contacts', ContactController::class);
    Route::resource('/albums', AlbumsController::class);
    Route::resource('/images', ImageController::class);
    Route::resource('/components', ComponentController::class);

    Route::get('/pages/', [PageController::class, 'index'])->name('admin.page.index');
    Route::get('/pages/create', [PageController::class, 'create'])->name('admin.page.create');
    Route::post('/pages/', [PageController::class, 'store'])->name('admin.page.store');
    Route::get('/pages/{page}', [PageController::class, 'show'])->name('admin.pages.show');
    Route::get('/pages/{page}/edit', [PageController::class, 'edit'])->name('admin.pages.edit');
    Route::patch('/pages/{page}', [PageController::class, 'update'])->name('admin.pages.update');
    Route::delete('/pages/{page}', [PageController::class, 'destroy'])->name('admin.pages.destroy');
    Route::post('/application-submit', [ApplicationSubmitController::class, 'submit']);

});
