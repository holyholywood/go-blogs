<?php

use App\Http\Controllers\API\v1\AuthController;
use App\Http\Controllers\API\v1\CategoryController;
use App\Http\Controllers\API\v1\MediaController;
use App\Http\Controllers\API\v1\PostController;
use App\Http\Controllers\API\v1\UserController;
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



Route::group(['prefix' => '/v1'], function () {
    /**
     * * Media Controller
     */
    Route::controller(MediaController::class)->prefix('/media')->name('Media')->middleware('auth:api')->group(function () {
        Route::post('/upload', 'store')->name('upload');
        Route::delete('/{media_name}', 'destroy')->name('delete');
    });

    /**
     * * Auth Controller
     */
    Route::controller(AuthController::class)->prefix('/auth')->name('Auth')->middleware('auth:api')->group(function () {
        Route::post('/login', 'login')->name('login')->withoutMiddleware('auth:api');
        Route::post('/logout', 'logout')->name('logout');
        Route::get('/me', 'me')->name('me');
        Route::post('/register', 'register')->name('Register')->withoutMiddleware('auth:api');
    });

    /**
     * * User Controller
     */
    Route::controller(UserController::class)->prefix('/users')->name('User')->middleware('auth:api')->group(function () {
        Route::get('/profile/{username}', 'show')->name('show')->withoutMiddleware('auth:api');
        Route::patch('/profile', 'update')->name('update');
        Route::delete('/profile', 'destroy')->name('delete');
    });

    /**
     * * Category Controller
     */
    Route::controller(CategoryController::class)->prefix('/categories')->name('Category')->middleware('auth:api')->group(function () {
        Route::get('/', 'index')->name('index')->withoutMiddleware('auth:api');
        Route::get('/{category_id}', 'show')->name('show')->withoutMiddleware('auth:api');
        Route::post('/', 'store')->name('store');
        Route::patch('/{category_id}', 'update')->name('update');
        Route::delete('/{category_id}', 'destroy')->name('delete');
    });

    /**
     * * Post Controller
     */
    Route::controller(PostController::class)->prefix('/posts')->name('Post')->middleware('auth:api')->group(function () {
        Route::get('/', 'index')->name('index')->withoutMiddleware('auth:api');
        Route::get('/{slug}', 'show')->name('show')->withoutMiddleware('auth:api');
        Route::post('/', 'store')->name('store');
        Route::patch('/{post_id}', 'update')->name('update');
        Route::delete('/{post_id}', 'destroy')->name('delete');

        /**
         * * -> Comment
         */
        Route::get('/{post_id}/comments', 'comments')->name('indexComment')->withoutMiddleware('auth:api');
        Route::get('/{post_id}/comments/{comment_id}', 'showComment')->name('showComment')->withoutMiddleware('auth:api');
        Route::post('/{post_id}/comments', 'storeComment')->name('storeComment');
        Route::patch('/{post_id}/comments/{comment_id}', 'updateComment')->name('updateComment');
        Route::delete('/{post_id}/comments/{comment_id}', 'destroyComment')->name('deleteComment');
    });
});
