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
Route::get('/users/index/{search?}', 'UserController@index')->name('users.index')->middleware('auth');
Route::get('/users/config', 'UserController@config')->name('user.config')->middleware('auth');
Route::post('/users/update', 'UserController@update')->name('user.update')->middleware('auth');
Route::get('/users/avatar/{filename}', 'UserController@getImage')->name('user.avatar')->middleware('auth');
Route::get('/users/perfile/{id}', 'UserController@profile')->name('user.perfile')->middleware('auth');

Route::get('/images/create', 'ImageController@create')->name('image.create')->middleware('auth');
Route::post('/image/save', 'ImageController@save')->name('image.save')->middleware('auth');
Route::get('/image/file/{filename}', 'ImageController@getImage')->name('image.file')->middleware('auth');
Route::get('/image/detail/{id}', 'ImageController@detail')->name('image.detail')->middleware('auth');
Route::get('/image/delete/{id}', 'ImageController@delete')->name('image.delete')->middleware('auth');
Route::get('/image/edit/{id}', 'ImageController@edit')->name('image.edit')->middleware('auth');
Route::post('/image/update', 'ImageController@update')->name('image.update')->middleware('auth');


Route::post('/comment/save', 'CommentController@save')->name('comment.save')->middleware('auth');
Route::get('/comment/save/{id}', 'CommentController@delete')->name('comment.delete')->middleware('auth');

Route::get('/like/{image_id}', 'LikeController@like')->name('like.save')->middleware('auth');
Route::get('/dislike/{image_id}', 'LikeController@dislike')->name('like.delete')->middleware('auth');
Route::get('/likes/index', 'LikeController@index')->name('like.index')->middleware('auth');
