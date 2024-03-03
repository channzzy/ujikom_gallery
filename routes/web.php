<?php

use App\Http\Controllers\AlbumPhotoController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\ProfileController;
use App\Models\AlbumPhoto;
use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/', [HomeController::class, 'index'])->name('/');

Route::middleware('auth')->group(function (){
    Route::controller(HomeController::class)->prefix('home')->name('home.')->group(function(){
        Route::post('/store','store')->name('store');
    });

    Route::controller(AlbumPhotoController::class)->prefix('albums')->name('album.')->group(function(){
        Route::get('/','index')->name('index');
        Route::get('/create','create')->name('create');
        Route::post('/store','store')->name('store');
        Route::get('/{id}/edit','edit')->name('edit');
        Route::put('/{id}/update','update')->name('update');
        Route::delete('/{id}/destroy','destroy')->name('destroy');
        Route::get('/{id}/detail','detail')->name('detail');
    });

    Route::controller(CommentController::class)->prefix('comments')->name('comment.')->group(function (){
        Route::get('/{id}/index', 'index')->name('index');
        Route::post('/{id}/store', 'store')->name('store');
        Route::delete('/{id}/{photo_id}/destroy', 'destroy')->name('destroy');
        Route::put('/{id}/{photo_id}/update', 'update')->name('update');
    });

    Route::controller(LikeController::class)->prefix('likes')->name('like.')->group(function (){
        Route::post('/{photo_id}/action', 'action')->name('action');
    });

    Route::controller(ProfileController::class)->prefix('profile')->name('profile.')->group(function (){
        Route::get('/', 'index')->name('index');
        Route::delete('/{id}/delete', 'destroy')->name('destroy');
        Route::get('/{id}/edit', 'edit')->name('edit');
        Route::put('/{id}/update', 'update')->name('update');
    });
});
