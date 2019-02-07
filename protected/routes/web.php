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

// Route Untuk Web Admin

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

// Master Data
Route::resource('/user', 'UserController');
Route::resource('/kelurahan', 'KelurahanController');


// Datatable
Route::get('/datatable_user', 'UserController@datatable')->name('datatable.user');
Route::get('/datatable_kelurahan', 'KelurahanController@datatable')->name('datatable.kelurahan');
