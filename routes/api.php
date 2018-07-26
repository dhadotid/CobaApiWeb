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
Route::post('login', 'API\UserController@login');
Route::post('register', 'API\UserController@register');
Route::post('kategori/store','API\ControllerKategori@store');
Route::post('keluhan/store','API\ControllerKeluhan@store');
Route::get('kategori','API\ControllerKategori@index');;
Route::get('kategori/search/{kategori}', 'API\ControllerKategori@search');
Route::post('keluhan_detail/store','API\ControllerKeluhanDetail@store');
Route::get('keluhan','API\ControllerKeluhan@index1');;
Route::get('keluhan/{NIM}','API\ControllerKeluhan@index');;
Route::get('rektorat','API\ControllerRektorat@index');
Route::get('rektorat_setengah','API\ControllerRektorat@index1');
Route::get('phone','API\ControllerPhone@index');
Route::get('unverifiedusers','API\UserController@datanol');
Route::get('manajer','API\ControllerManajer@index');
Route::get('surveyor','API\ControllerSurveyor@index');
Route::post('surveyor/update/{id_keluhan}','API\ControllerSurveyor@update');
Route::get('chat/{NIM}','API\ControllerChat@index');
Route::post('manajer/update/{id_keluhan}','API\ControllerManajer@update');
Route::post('users/update/{NIM}','API\UserController@update');
Route::post('users/verif','API\UserController@verifuser');
Route::get('users','API\UserController@index');
Route::get('keluhan_detail/{id_keluhan}','API\ControllerKeluhanDetail@index');
Route::get('chart','API\ControllerChart@index');
Route::get('launcher','API\ControllerLaunch@index');
Route::get('pdf/{id_laucher}','API\ControllerLaunch@index1');
Route::get('pdf_category/{id_pdf}','API\ControllerLaunch@pdf');
Route::get('pdf_search/{nama}','API\ControllerLaunch@cari');
Route::get('pdf_detail/{id_pdf}','API\ControllerLaunch@pdf_detail');
Route::get('pdf_detailby/{id_pdfdetail}','API\ControllerLaunch@pdf_detailby');
Route::post('pdf/store','API\ControllerPdf@store');
Route::post('pdf/update/{id_pdfdetail}','API\ControllerPdf@update');

Route::post('rating/{NIM}','API\ControllerRating@store');

Route::get('chat/hoho/{NIM}','API\ControllerChat@create');
Route::get('chat/detail/{Nama}/{Penerima}','API\ControllerChat@store');
Route::post('chat','API\ControllerChat@show');
Route::post('rating','API\ControllerChat@edit');
Route::get('rating/{id}','API\ControllerChat@update');

Route::get('/email', function () {
    return view('send_email');
});
Route::post('/sendEmail', 'API\UserController@sendEmail');
