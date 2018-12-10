<?php

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

Route::get('/home', 'HomeController@index')->name('home');

Route::prefix('admin')->group(function(){
    Route::get('/', 'Admin\AdminController@index')->name('admin.dashboard');
    Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
    Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');
});

Route::get('/verifyemail/{token}', 'Auth\RegisterController@verify');

Route::view('/send-email', 'auth.send-email');


Route::prefix('product')->group(function(){
    Route::get('/', 'Admin\ProductController@index')->name('admin.product.index');
    Route::get('/show/{item}', 'Admin\ProductController@show')->name('admin.product.show');
    Route::get('/create', 'Admin\ProductController@create')->name('admin.product.create');
    Route::post('/store', 'Admin\ProductController@store')->name('admin.product.store');
    Route::get('/edit/{item}', 'Admin\ProductController@edit')->name('admin.product.edit');
});