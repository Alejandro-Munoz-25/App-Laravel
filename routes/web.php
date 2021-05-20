<?php

use App\Http\Controllers\Auth\ChangePasswordController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\UserController;
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


// ! Middleware auth se encuentra en el kernel

Route::get('/', [Controller::class, 'index'])->middleware(['auth'])->name('home');

require __DIR__ . '/auth.php';

Route::middleware(['auth'])->group(function () {
    // *Users
    Route::get('/config', [UserController::class, 'config'])->name('config');
    Route::post('/user/update', [UserController::class, 'update'])->name('user.update');
    Route::get('/user/avatar/{filename}', [UserController::class, 'getImage'])->name('user.avatar');
    Route::get('/profile/{id}', [UserController::class, 'profile'])->name('user.profile');
    // Al agregar el signo se convierte en parametro opcional
    Route::get('/profiles/{search?}', [UserController::class, 'index'])->name('user.index');
    Route::post('/profiles/{search?}', [UserController::class, 'index'])->name('user.index');
    Route::get('/change-password', [ChangePasswordController::class, 'index'])->name('change.form');
    Route::post('change-password', [ChangePasswordController::class, 'store'])->name('change.password');
    Route::get('/delete-user', [UserController::class, 'delete'])->name('user.delete');

    // *Images
    Route::get('/post-image', [ImageController::class, 'create'])->name('image.create');
    Route::post('/image/save', [ImageController::class, 'save'])->name('image.save');
    Route::get('/image/file/{filename}', [ImageController::class, 'getImage'])->name('image.file');
    Route::get('/image/detail/{id}', [ImageController::class, 'detail'])->name('image.detail');
    Route::get('/image/delete/{id}', [ImageController::class, 'delete'])->name('image.delete');
    Route::get('/image/edit/{id}', [ImageController::class, 'edit'])->name('image.edit');
    Route::post('/image/update', [ImageController::class, 'updateImage'])->name('image.update');

    // *Comments
    Route::post('/comment/save/{id}', [CommentController::class, 'save'])->name('comment.save');
    Route::get('/comment/delete/{id}', [CommentController::class, 'delete'])->name('comment.delete');

    // *Likes
    Route::get('/like/{image_id}', [LikeController::class, 'like'])->name('like.save');
    Route::get('/dislike/{image_id}', [LikeController::class, 'dislike'])->name('like.delete');
    Route::get('/likes', [LikeController::class, 'index'])->name('likes.index');
});
