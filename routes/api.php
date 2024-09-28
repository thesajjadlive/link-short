<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\LinkController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::controller(AuthController::class)->prefix('v1')->group(function () {
    Route::post('register', 'register')->middleware('checkAPI');
    Route::post('login', 'login')->middleware('checkAPI');
    Route::post('logout', 'logout');
});

Route::middleware('api')->prefix('v1')->group(function (){
    Route::post('/shorten', [LinkController::class, 'shorten']);
    Route::get('/{shortCode}', [LinkController::class, 'redirect']);
    Route::get('/links', [LinkController::class, 'links'])->middleware('checkAPI');;
});

