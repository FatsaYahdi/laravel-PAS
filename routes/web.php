<?php

use App\Http\Controllers\ImageController;
use App\Models\Image;
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
    return view('welcome')->with([
        'images' => Image::all()
    ]);
})->name('home');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::prefix('dashboard')->group(function () {
        Route::get('/', function () {
            return view('dashboard')->with([
                'imgs' => Image::all()
            ]);
        })->name('dashboard')->middleware(['admin']);
    });
    Route::controller(ImageController::class)->group(function () {
        Route::get('/image/{slug}', 'show')->name('image.show');
        Route::get('/images', 'index')->name('image.index');
    });
});
