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

    // Admin User
    Route::get('/admin-user', 'Admin\AdminUserController@index')->name('admin-users');
    Route::get('/admin-user/create', 'Admin\AdminUserController@create')->name('admin-users.create');
    Route::post('/admin-users/store', 'Admin\AdminUserController@store')->name('admin-users.store');
});

Route::get('/verifyemail/{token}', 'Auth\RegisterController@verify');

Route::view('/send-email', 'auth.send-email');

// Datatables
Route::get('/datatables-admin-users', 'Admin\AdminUserController@getIndex')->name('datatables.admin_users');

Route::prefix('product')->group(function(){
    Route::get('/', 'Admin\ProductController@index')->name('admin.product.index');
    Route::get('/show/{item}', 'Admin\ProductController@show')->name('admin.product.show');
    Route::get('/create', 'Admin\ProductController@create')->name('admin.product.create');
    Route::post('/store', 'Admin\ProductController@store')->name('admin.product.store');
    Route::get('/edit/{item}', 'Admin\ProductController@edit')->name('admin.product.edit');
});

// Select2
Route::get('/select-roles', 'Admin\RoleController@getRoles')->name('select.roles');