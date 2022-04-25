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

Route::post('/login', 'App\Http\Controllers\User\AuthController@login')
    ->name('/login');

Route::get('admin/login', function () {
    return view('admin.pages.auth.login');
});

Route::post('/admin/login', 'App\Http\Controllers\Admin\AuthController@login')
    ->name('admin/login');

Route::group(['middleware' => ['auth:user']], function () {

    Route::post('/user/logout', 'App\Http\Controllers\User\AuthController@logout');

    Route::get('/user/index', 'App\Http\Controllers\User\IndexController@index')
        ->name('/user/index');

    Route::group(['prefix' => 'user/products', 'as' => 'user/products.'], function () {

        Route::get('', 'App\Http\Controllers\User\ProductController@index');

    });

});

Route::group(['middleware' => ['auth:admin']], function () {

    Route::post('/admin/logout', 'App\Http\Controllers\Admin\AuthController@logout');

    Route::get('/admin/index', 'App\Http\Controllers\Admin\IndexController@index')
        ->name('/admin/index');

    Route::group(['prefix' => 'product', 'as' => 'product.'], function () {
        Route::get('/', 'App\Http\Controllers\Admin\ProductController@index')
            ->name('product');
    });

});