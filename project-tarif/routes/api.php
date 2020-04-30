<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::get('tarifdokumen', 'API\DataTarifController@getTarifDokumen');
Route::get('tarifmakanan', 'API\DataTarifController@getTarifMakanan');
Route::get('tarifnonmakanan', 'API\DataTarifController@getTarifNonMakanan');

Route::get('asalpengiriman', 'API\BaseDataController@getAsalPengiriman');
Route::get('beratdokumen', 'API\BaseDataController@getBeratDokumen');
Route::get('tujuandokumen', 'API\BaseDataController@getTujuanDokumen');
Route::get('tujuanmakanannon', 'API\BaseDataController@getTujuanMakananNonMakanan');
Route::get('tujuanmakanan', 'API\BaseDataController@getTujuanMakanan');
Route::get('kategori', 'API\BaseDataController@getKategori');

Route::get('find/asal', 'API\BaseDataController@findAsalPengiriman');
Route::get('find/berat', 'API\BaseDataController@findBeratDokumen');
Route::get('find/tujuandokumen', 'API\BaseDataController@findTujuanDokumen');
Route::get('find/tujuanmakanan', 'API\BaseDataController@findTujuanMakanan');
Route::get('find/tujuannonmakanan', 'API\BaseDataController@findTujuanNonMakanan');
Route::get('find/kategori', 'API\BaseDataController@findKategori');
