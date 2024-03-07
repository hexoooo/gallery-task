<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\GalleryController;

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

Route::view('/', 'dashboard.site.home.index')->name('/');

Route::resource('galleries', GalleryController::class)->except('update');
Route::POST('galleries/{gallery}', [GalleryController::class, 'update'])->name('galleries.update');
Route::resource('images', ImageController::class);
