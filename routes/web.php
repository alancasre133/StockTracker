<?php

use Illuminate\Support\Facades\Route;
use App\Models\Stock;
use App\Models\User;
use App\Http\Controllers\UserController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\StockAndUserController;
use App\Http\Controllers\AuthController;

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/stocks/refresh', [StockController::class, 'refreshPrices'])->name('stocks.refresh');
Route::resource('stock_and_user', StockAndUserController::class);
Route::middleware(['auth'])->group(function () {
    Route::resource('stocks', StockController::class);
});
Route::delete('/stock_and_user/erase/{stockName}/{userEmail}', [StockAndUserController::class, 'erase'])->name('stock_and_user.erase');
Route::resource('users', UserController::class);

Route::get('/', function () {
    return view('welcome');
});
