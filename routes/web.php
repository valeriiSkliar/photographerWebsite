<?php

use App\Http\Controllers\Admin\AdminPanelController;
use App\Http\Controllers\Admin\AlbumsController;
use App\Http\Controllers\Admin\Component\ComponentController;
use App\Http\Controllers\Admin\Page\PageController;
use App\Http\Controllers\Admin\Section\SectionController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ImageUploadController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [IndexController::class, 'index'])->name('index.page');

Route::get('/about', function () {
    return view('about',);
});

Route::get('/portfolio', function () {
    return view('portfolio',);
});

Route::get('/work', function () {
    return view('work',);
});

Route::get('/contact', function () {
    return view('contact',);
});

Route::get('/albumsooo', [AlbumsController::class , '__invoke'])->name('getAllAlbums');
Route::get('/albums/{id}', [AlbumsController::class , 'show_album'])->name('show_album');
Route::get('/gallery', [GalleryController::class, 'index'])->name('gallery.index');

Route::post('/upload', [ImageUploadController::class, 'uploadMethod']);
Route::post('/create-album', [ImageUploadController::class, 'createAlbum']);

Route::get('/test', [\App\Http\Controllers\TestController::class, '__invoke'])->name('test');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::resource('sections', SectionController::class);
Route::resource('components', ComponentController::class);

Route::group(['prefix' => 'admin', 'middleware'=> 'auth'],function () {
    Route::get('/', [AdminPanelController::class, '__invoke'])->name('index.dashboard');
    Route::get('/dashboard', [AdminPanelController::class, '__invoke'])->name('index.dashboard');

    Route::resource('/albums', AlbumsController::class);

    Route::group(['prefix' => 'pages',],function () {
        Route::get('/', [PageController::class, 'index'])->name('admin.page.index');
        Route::get('/create', [PageController::class, 'create'])->name('admin.page.create');
        Route::post('/', [PageController::class, 'store'])->name('admin.page.store');
        Route::get('/{page}', [PageController::class, 'show'])->name('admin.pages.show');
        Route::get('/{page}/edit', [PageController::class, 'edit'])->name('admin.pages.edit');
        Route::patch('/{page}', [PageController::class, 'update'])->name('admin.pages.update');
        Route::delete('/{page}', [PageController::class, 'destroy'])->name('admin.pages.destroy');
    });

});

require __DIR__.'/auth.php';

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
