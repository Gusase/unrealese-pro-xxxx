<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\PesanController;
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
    Route::view('/signup', 'auth.signup');
    Route::post('/signup', [AuthController::class, 'signup']);
    Route::view('/signin', 'auth.signin');
    Route::post('/signin', [AuthController::class, 'signin'])->name('signin');
});

Route::middleware('auth')->group(function () {
    Route::get('/signout', [AuthController::class, 'signout']);
    Route::post('/signout', [AuthController::class, 'signout']);

    Route::get('/', [UserController::class, 'index']);
    Route::get('/baru', [FileController::class, 'create']);
    Route::resource('file', FileController::class);
    Route::resource('user', UserController::class);
    Route::get('/file/show/{id_file}/{generate_filename}', [FileController::class, 'show']);
    Route::get('/download/{id_file}/{id_user}/{generate_filename}', [FileController::class, 'downloadPrivate']);
    Route::get('/d/{id_file}/{filename}', [FileController::class, 'downloadPublic']);
    Route::get('/do/{id_file}', [FileController::class, 'download']);
    Route::get('/global-file/show/{id_file}/{generate_filename}', [FileController::class, 'show']);
    Route::get('/global-file', [FileController::class, 'index']);
    Route::get('/admin', [AdminController::class, 'index']);
    Route::post('/verified/{id_user}', [AdminController::class, 'verified']);
    Route::post('/hapusUser/{id_user}', [AdminController::class, 'destroy']);
    Route::get('/admin/edit/{id_user}', [AdminController::class, 'edit']);
    Route::post('/editUser/{id_user}', [AdminController::class, 'update']);
    Route::get('/notifikasi', [PesanController::class, 'index']);
    Route::get('/notifikasi/{id_pesan}', [PesanController::class, 'show']);
    Route::resource('pesan', PesanController::class);
    Route::get('username', [UserController::class, 'ajax']);
});