<?php

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
    return view('user.pages.auth.login');
});

Route::get('login', function () {
    return view('user.pages.auth.login');
});

Route::post('/login-user', ['User\AuthController@login'])
    ->name('login-user');

Route::get('login-admin', function () {
    return view('admin.pages.auth.login');
});

Route::post('/login-admin', ['Admin\AuthController@login'])
    ->name('login-admin');

Route::group(['middleware' => ['auth:user']], function () {

    Route::post('/logout-user', [UserController::class, 'logout']);

    Route::group(['prefix' => 'product', 'as' => 'product.'], function () {
        Route::get('/', 'User\ProductController@index')
            ->name('index');
    });

});