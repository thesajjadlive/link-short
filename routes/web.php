<?php

use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LinkController;
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

Auth::routes();

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::group(['middleware' => 'auth'], function () {
    Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard');
    Route::post('/destroy/{id}', [HomeController::class, 'destroy'])->name('destroy');
});

Route::post('/shorten', [LinkController::class, 'shorten'])->name('shorten');
Route::get('/{shortCode}', [LinkController::class, 'redirect']);


