<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\NoteController;
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

Route::middleware('auth')->group(function () {
    Route::get('/', [AuthController::class, 'index'])->name('index');
});

Route::middleware('auth')->group(function () {
    Route::resource('notes', NoteController::class);
});
Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::POST('/register', [AuthController::class, 'register'])->name('register');
    Route::POST('/login', [AuthController::class, 'login'])->name('login');
});
Route::POST('/logout', [AuthController::class, 'logout'])->name('logout');

