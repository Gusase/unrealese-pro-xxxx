<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\UserController;
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

Route::middleware('guest')->group(function () {
    Route::view('/signup', 'auth.signup')->name('login');
    Route::post('/signup', [AuthController::class, 'signup']);
    Route::view('/signin', 'auth.signin');
    Route::post('/signin', [AuthController::class, 'signin']);
});

Route::middleware('auth')->group(function () {
    Route::get('/signout', [AuthController::class, 'signout']);
    Route::post('/signout', [AuthController::class, 'signout']);

    Route::get('/', [UserController::class, 'index']);
    Route::view('/baru', 'user.file.create', ['title' => 'File Baru']);
    Route::resource('file', FileController::class);
    Route::get('/file/show/{id_file}/{generate_filename}', [FileController::class, 'show']);
    Route::get('/download/{id_file}/{id_user}/{generate_filename}', [FileController::class, 'downloadPrivate']);
    Route::get('/d/{id_file}/{filename}', [FileController::class, 'downloadPublic']);
    Route::get('/do/{id_file}', [FileController::class, 'download']);
    Route::get('/file-global/show/{id_file}/{generate_filename}', [FileController::class, 'show']);
    Route::get('/file-global', [FileController::class, 'index']);
    Route::get('/admin', [AdminController::class, 'index']);
    Route::post('/verified/{id_user}', [AdminController::class, 'verified']);
    Route::post('/hapusUser/{id_user}', [AdminController::class, 'destroy']);
    Route::post('/admin/edit/{id_user}', [AdminController::class, 'edit']);
    Route::post('/admin/editUser/{id_user}', [AdminController::class, 'update']);
});