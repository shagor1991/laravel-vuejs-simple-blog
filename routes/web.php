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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// Admin Category
Route::post('/category','CategoryController@store');
Route::get('/category-list','CategoryController@list');
Route::get('/category/{id}','CategoryController@category');
Route::post('/category/{id}','CategoryController@update');
Route::get('/category-delete/{id}','CategoryController@delete');

// Admin Post
Route::get('/posts','PostController@posts');
Route::post('/post','PostController@store');
Route::post('/post/{id}','PostController@update');
Route::get('/post-delete/{id}','PostController@delete');
Route::get('/post/{id}','PostController@post');