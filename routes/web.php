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

Route::get('/', 'HomeController@index')->name('home');
Route::get('/post-detail/{post_id}', 'HomeController@detail');
Route::resource('posts', 'PostController');
Auth::routes();
Route::get('admin/content_manager', 'PostController@content_manager')->middleware('admin');
Route::get('admin/publish/{post_id}', 'PostController@publish')->middleware('admin');
Route::post('admin/auto_publish/{post_id}', 'PostController@auto_publish')->middleware('admin');
Route::match(array('GET', 'POST'), 'admin/search', 'PostController@filter');