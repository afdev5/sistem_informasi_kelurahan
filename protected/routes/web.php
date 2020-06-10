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
Route::resource('/kecamatan', 'KecamatanController');

//Profile Kelurahan
Route::resource('/profile_kelurahan', 'Profile\KelurahanProfileController');
Route::resource('/info_kelurahan', 'Profile\InfoKelurahanController');
Route::resource('/kegiatan_kelurahan', 'Profile\KegiatanKelurahanController');
Route::resource('/struktur_kelurahan', 'Profile\StrukturKelurahanController');
Route::resource('/wilayah', 'Profile\WilayahKelurahanController');

//Penduduk
Route::resource('/penduduk', 'PendudukController');
Route::post('/penduduk_kelurahan', 'PendudukController@kelurahan')->name('penduduk.k');


// Datatable
Route::get('/datatable_user', 'UserController@datatable')->name('datatable.user');
Route::get('/datatable_kelurahan', 'KelurahanController@datatable')->name('datatable.kelurahan');
Route::get('/datatable_kecamatan', 'KecamatanController@datatable')->name('datatable.kecamatan');
Route::get('/datatable_penduduk', 'PendudukController@datatable')->name('datatable.penduduk');
Route::get('/datatable_kegiatan', 'Profile\KegiatanKelurahanController@datatable')->name('datatable.kegiatan');
Route::get('/datatable_struktur', 'Profile\StrukturKelurahanController@datatable')->name('datatable.struktur');
Route::get('/datatable_wilayah', 'Profile\WilayahKelurahanController@datatable')->name('datatable.wilayah');
Route::get('/datatable_penduduk/{id}', 'PendudukController@dt')->name('datatable.pendudukk');

//Export / Import Excel
Route::get('/export', 'PendudukController@export')->name('penduduk.export');
Route::post('/import', 'PendudukController@import')->name('penduduk.import');
Route::get('/format', 'PendudukController@format')->name('penduduk.format');

// Statistik
// Pendidikan
Route::get('/statistik_pendidikan', 'StatistikController@pendidikan')->name('statistik.pendidikan');
Route::post('/statistik_pendidikann', 'StatistikController@pendidikann')->name('statistik.pendidikann');
// Usia
Route::get('/statistik_usia', 'StatistikController@usia')->name('statistik.usia');
Route::post('/statistik_usiaa', 'StatistikController@usiaa')->name('statistik.usiaa');
// Jenis Kelamin
Route::get('/statistik_jk', 'StatistikController@jk')->name('statistik.jk');
Route::post('/statistik_jkk', 'StatistikController@jkk')->name('statistik.jkk');
// Status Kawin
Route::get('/statistik_kawin', 'StatistikController@kawin')->name('statistik.kawin');
Route::post('/statistik_kawinn', 'StatistikController@kawinn')->name('statistik.kawinn');
// Agama
Route::get('/statistik_agama', 'StatistikController@agama')->name('statistik.agama');
Route::post('/statistik_agamaa', 'StatistikController@agamaa')->name('statistik.agamaa');
