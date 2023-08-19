<?php

use App\Http\Controllers\API\v1\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

/**
 * * Auth Controller
 */
Route::controller(AuthController::class)->prefix('/auth')->name('Auth')->middleware('auth:api')->group(function () {
    Route::post('/login', 'login')->name('login')->withoutMiddleware('auth:api');
    Route::post('/logout', 'logout')->name('logout');
    Route::get('/me', 'me')->name('me');
    Route::post('/register', 'register')->name('Register')->withoutMiddleware('auth:api');
});
