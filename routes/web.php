<?php

use App\Http\Controllers\AsynchroneMessageController;
use App\Http\Controllers\dashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\TchatController;
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

Route::get('/', [RegisterController::class, 'register_form'])->name('register');
Route::post('/', [RegisterController::class, 'register']);

Route::get('login', [LoginController::class, 'login_form'])->name('login');
Route::post('login', [LoginController::class, 'login']);

Route::get('/dashboard', [dashboardController::class, 'index'])->name('dashboard');

Route::get('/tchat/{user}', [TchatController::class, 'index'])->name('tchat');


Route::get('/add/message/{user_id}', [AsynchroneMessageController::class, 'add']);
