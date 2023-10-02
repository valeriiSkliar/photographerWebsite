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

Route::get('/', function () {

  $images = ['https://raw.githubusercontent.com/semklim/Waxom_ITStep_Landing/main/img/Slider/matterhorn.jpg', "https://raw.githubusercontent.com/semklim/Waxom_ITStep_Landing/main/img/Slider/water.jpg", "https://raw.githubusercontent.com/semklim/Waxom_ITStep_Landing/main/img/Slider/rocks_2.jpg", "https://raw.githubusercontent.com/semklim/Waxom_ITStep_Landing/main/img/Slider/mountain3.jpg"];
    return view('index', compact('images'));
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

require __DIR__.'/auth.php';
