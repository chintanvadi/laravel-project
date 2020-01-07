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

//Route::get('/', function () {
//    return view('welcome');
//});

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
Route::get('/dashboard','HomeController@dashboard')->name('dashboard');
Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');
Route::resource('role', 'RoleController');
Route::resource('user', 'UserController');
Route::match(['get', 'post'], 'ajax-image-upload', 'UserController@ajaxImage');
