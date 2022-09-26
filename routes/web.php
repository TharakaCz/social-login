<?php

use App\Http\Controllers\FacebookController;
use App\Http\Controllers\GoogleController;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('facebook')->name('facebook.')->group(function () {
    Route::get('auth', [FacebookController::class, 'login'])->name('login');
    Route::get('callback', [FacebookController::class, 'callback'])->name('callback');
});

Route::prefix('google')->name('google.')->group(function () {
    Route::get('auth', [GoogleController::class, 'login'])->name('login');
    Route::get('callback', [GoogleController::class, 'callback'])->name('callback');
});
