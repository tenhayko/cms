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
Route::resource('products', 'ProductController');
Route::prefix('admin')->group(function(){
    Route::get('/', 'Admin\AdminController@index')->name('admin');
    Route::get('/login','Auth\AdminLoginController@showLoginForm')->name('admin.login');
    Route::post('/login','Auth\AdminLoginController@login')->name('admin.login.submit');
    Route::post('/logout','Auth\AdminLoginController@logout')->name('admin.logout');
    //login google Authenticator
    Route::post('/google','Auth\AdminLoginController@postQrcode')->name('admin.qrcode');
});
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::prefix('image')->group(function(){
	Route::get('/manager', 'ImageController@manager')->name('image.manager');
	Route::delete('/manager/delete', 'ImageController@managerDelete')->name('image.manager.delete');
	Route::post('/upload', 'ImageController@upload')->name('image.upload');
	Route::post('/delete', 'ImageController@delete')->name('image.delete');
});