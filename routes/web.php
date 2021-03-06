<?php

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

Route::get('/', 'App\Http\Controllers\PagesController@index');


Route::post('register/login', 'App\Http\Controllers\API\RegisterController@login');

Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home');

//Route::resource('product', 'App\Http\Controllers\ProductController');

//Route::resource('post_blog', 'App\Http\Controllers\PagesController@postBlog');

