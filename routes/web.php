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

Route::resource('galleries', GalleryController::class);
Route::post('/addimage/{gallery}', [GalleryController::class, 'addImage'])->name('galleries.addimage');
Route::post('/delete-image/{gallery}/{id}', [GalleryController::class, 'deleteImage'])->name('galleries.deleteImage');
Route::post('/change-image-name/{gallery_id}/{image_id}', [GalleryController::class, 'changeImageName'])->name('galleries.ChangeImageName');
Route::post('/galleries/move-image', [GalleryController::class, 'deleteMoveImage'])->name('galleries.moveImageDelete');
