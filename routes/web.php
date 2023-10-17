<?php

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

Route::get('/albums', [\App\Http\Controllers\AlbumsController::class , '__invoke'])->name('getAllAlbums');
Route::get('/albums/{id}', [\App\Http\Controllers\AlbumsController::class , 'show_album'])->name('show_album');

Route::get('/', function () {

  $images = ['https://raw.githubusercontent.com/semklim/Waxom_ITStep_Landing/main/img/Slider/matterhorn.jpg', "https://raw.githubusercontent.com/semklim/Waxom_ITStep_Landing/main/img/Slider/water.jpg", "https://raw.githubusercontent.com/semklim/Waxom_ITStep_Landing/main/img/Slider/rocks_2.jpg", "https://raw.githubusercontent.com/semklim/Waxom_ITStep_Landing/main/img/Slider/mountain3.jpg"];
    return view('index', compact('images'));
});

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

Route::get('/test', [\App\Http\Controllers\TestController::class, '__invoke'])->name('test');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::group(['namespace' => 'Admin', 'prefix' => 'admin', 'middleware'=> 'auth'],function () {
   Route::get('/', [\App\Http\Controllers\Admin\AdminPanelController::class, '__invoke'])->name('index.dashboard');
   Route::get('/dashboard', [\App\Http\Controllers\Admin\AdminPanelController::class, '__invoke'])->name('index.dashboard');
});

require __DIR__.'/auth.php';

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
