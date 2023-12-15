<?php

use App\Http\Controllers\Admin\Component\ComponentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ImageOrderController;
use App\Http\Controllers\ImageUploadController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\ProfileController;
use App\Models\Page;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;
use Modules\ImageManager\Http\Controllers\ImageManagerController;
use App\Http\Controllers\Admin\ApplicationSubmitController;

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

$databaseName = config('database.connections.mysql.database');
//$locales = ['en', 'de', ''];
$locales = array_merge(config('app.available_locales'), ['default_routes' => '']);
//Route::get("/", [IndexController::class, 'index'])->name("index.page");

foreach ($locales as $locale) {
    Route::get("/{$locale}", [IndexController::class, 'index'])->name("{$locale}.index.page");
}

Route::get('/language/{locale}', function ($locale) {
    app()->setLocale($locale);
    session()->put('locale', $locale);
    return redirect()->back();
});

try {
    $connection = DB::connection()->getPdo();
    $databaseExists = DB::select("SHOW DATABASES LIKE '$databaseName'");

    if ($databaseExists) {
        DB::statement("USE `$databaseName`");

        if (Schema::hasTable('pages')) {
            $pages = Page::all();

            foreach ($pages as $page) {
                foreach ($locales as $locale) {
                    $prefix = $locale ? $locale . "/" : $locale;
                    $index = $locale ?: "default";
                    Route::get($prefix . $page->slug, [IndexController::class, 'index'])->name($index . '.page.' . $page->slug);

                }
            }
        }
    }

} catch (Exception $e) {
//    dd($e);
}


Route::post('/upload', [ImageUploadController::class, 'uploadMethod']);
Route::post('/create-album', [ImageUploadController::class, 'createAlbum']);
Route::post('/delete-selected-images', [ImageUploadController::class, 'deleteSelectedImages']);
Route::post('/add-selected-images', [ImageUploadController::class, 'addSelectedImagesToAlbum']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/get-component-form/{id}', [ComponentController::class, 'getFormMarkup']);
Route::post('/components/{id}/update', [ComponentController::class, 'update']);
Route::post('/components/{id}/destroy', [ComponentController::class, 'destroy']);
Route::post('/application-submit', [ApplicationSubmitController::class, 'submit']);

require __DIR__ . '/auth.php';
require __DIR__ . '/admin.php';

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
