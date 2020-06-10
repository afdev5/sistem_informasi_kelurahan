<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/beranda', 'Api\ProfilController@beranda');
Route::get('/info', 'Api\ProfilController@info');
Route::get('/wilayah', 'Api\ProfilController@wilayah');
Route::get('/statistik_pendidikan', 'Api\ProfilController@statistik_pendidikan');
Route::get('/statistik_usia', 'Api\ProfilController@statistik_usia');
Route::get('/statistik_agama', 'Api\ProfilController@statistik_agama');
Route::get('/statistik_jk', 'Api\ProfilController@statistik_jk');
Route::get('/statistik_kawin', 'Api\ProfilController@statistik_kawin');
Route::get('/kegiatan', 'Api\ProfilController@kegiatan');
Route::get('/detail_kegiatan', 'Api\ProfilController@detail_kegiatan');
Route::get('/galeri', 'Api\ProfilController@galeri');