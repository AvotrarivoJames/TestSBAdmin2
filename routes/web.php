<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

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
    return view('welcome');
});

Route::get('register', [RegisterController::class, 'index'])->name('register-user');
Route::post('register', [RegisterController::class, 'signUp'])->name('register.custom');

Route::get('login', [LoginController::class, 'index'])->name('auth.login');
Route::post('custom-login', [LoginController::class, 'login'])->name('login.custom');

Route::middleware(['auth'])->group(function () {
    Route::get('logout', [LoginController::class, 'logout'])->name('logout');

});
