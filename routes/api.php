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



Route::middleware('auth:api')->put('/user/update/{id}','UserController@update');

Route::middleware('api')->post('/user/login','UserController@login');

Route::middleware('auth:api')->post('/admin/logout','UserController@api_logout');
Route::middleware('auth:api')->post('/orangtua/logout','UserController@api_logout');
Route::middleware('auth:api')->post('/siswa/logout','UserController@api_logout');


Route::middleware('auth:api')->get('/cek/orangtua','OrangtuaController@getOrangtua');
Route::middleware('auth:api')->get('/cek/orangtua/anak','OrangtuaController@detailsAnak');
Route::middleware('auth:api')->get('/cek/siswa','StudentController@getSiswa');


Route::middleware('auth:api')->get('/siswa/profil/detail/{id}','StudentController@api_detailProfil');

Route::middleware('auth:api')->get('/orangtua/profil/detail/{id}','OrangtuaController@api_detailProfil');
Route::middleware('auth:api')->put('/orangtua/profil/update/{id}','OrangtuaController@api_updateProfil');
Route::middleware('auth:api')->post('/orangtua/profil/update/password/{id}','OrangtuaController@api_updatePasswOrtu');
Route::middleware('auth:api')->put('/orangtua/anak/update/{id}','StudentController@updateAnak');
Route::middleware('auth:api')->post('/orangtua/anak/update/password/{id}','OrangtuaController@api_updatePasswSiswa');
Route::middleware('auth:api')->delete('/orangtua/anak/deleteanak/{id}','StudentController@deleteAnak');
Route::middleware('auth:api')->get('/log','OrangtuaController@api_LogActivity');
Route::middleware('auth:api')->get('/log/activity', 'OrangtuaController@activityReport');
Route::middleware('auth:api')->get('/log/study','OrangtuaController@studyReport');



Route::middleware('auth:api')->put('/orangtua/editanak/{id}','StudentController@api_detailProfil');


// forgot password
Route::middleware('api')->post('/orangtua/forgot-password','Auth\ForgotPasswordAPIController');

// untuk registrasi
Route::middleware('api')->post('/user/orangtua','UserController@regisortu');
Route::middleware('api')->post('/user/siswa','UserController@regisSiswa');


Route::middleware('auth:api')->get('/province','ProvinceController@getProvince');
Route::middleware('auth:api')->get('/regency','RegencyController@getRegency');
Route::middleware('auth:api')->get('/district','DistrictController@getDistrict');

// untuk api create user
// Route::middleware('api')->post('/user','UserController@store');
// BERITA
Route::middleware('auth:api')->get('/berita','OrangtuaController@getNews');
Route::middleware('auth:api')->get('/cek/orangtua','OrangtuaController@getOrangtua');
Route::middleware('auth:api')->get('/cek/siswa','StudentController@getSiswa');


// untuk kategori game
Route::middleware('auth:api')->get('/gamecategory','GameCategoryController@getGameCategory');
Route::middleware('auth:api')->post('/gamecategory/store','GameCategoryController@store');
Route::middleware('auth:api')->get('/gamecategory/detail/{id}','GameCategoryController@show');
Route::middleware('auth:api')->put('/gamecategory/update/{id}','GameCategoryController@update');
Route::middleware('auth:api')->delete('/gamecategory/delete/{id}','GameCategoryController@destroy');

// untuk kategori mapel
Route::middleware('auth:api')->get('/subjectscategory','SubjectsCategoryController@getSubjectsCategory');
Route::middleware('auth:api')->post('/subjectscategory/store','SubjectsCategoryController@store');
Route::middleware('auth:api')->get('/subjectscategory/detail/{id}','SubjectsCategoryController@show');
Route::middleware('auth:api')->put('/subjectscategory/update/{id}','SubjectsCategoryController@update');
Route::middleware('auth:api')->delete('/subjectscategory/delete/{id}','SubjectsCategoryController@destroy');


// untuk api game
Route::middleware('auth:api')->get('/games','GamesController@getGames');
Route::middleware('auth:api')->post('/games/store','GamesController@store');
Route::middleware('auth:api')->get('/games/detail/{id}','GamesController@show');
Route::middleware('auth:api')->put('/games/update/{id}','GamesController@update');
Route::middleware('auth:api')->delete('/games/delete/{id}','GamesController@destroy');

// untuk api ebook
Route::middleware('auth:api')->get('/ebook','EbookController@getEbook');
Route::middleware('auth:api')->get('/ebook/class/','EbookController@getEbookClass');
Route::middleware('auth:api')->post('/ebook/store','EbookController@store');
Route::middleware('auth:api')->get('/ebook/detail/{id}','EbookController@show');
Route::middleware('auth:api')->put('/ebook/update/{id}','EbookController@update');
Route::middleware('auth:api')->delete('/ebook/delete/{id}','EbookController@destroy');


// untuk api bank soal
Route::middleware('auth:api')->get('/banksoal/class/','TaskMasterController@getTaskMasterClass');
Route::middleware('auth:api')->post('/banksoal/store','TaskMasterController@store');
Route::middleware('auth:api')->get('/banksoal/detail/{id}','TaskMasterController@show');
Route::middleware('auth:api')->put('/banksoal/update/{id}','TaskMasterController@update');
Route::middleware('auth:api')->delete('/banksoal/delete/{id}','TaskMasterController@destroy');
// jalan buat nampilin nilai siswa mengerjakan soal
Route::middleware('auth:api')->post('/siswa/nilai','StudentController@api_getScore');
Route::middleware('auth:api')->get('/banksoal/soal','TaskMasterController@api_soal');
Route::middleware('auth:api')->get('/banksoal/pertanyaan','TaskMasterController@getPertanyaan');
Route::middleware('auth:api')->get('/banksoal/pilihan','TaskMasterController@getPilihan');



//store log events
Route::middleware('auth:api')->post('/log/ebook','EbookController@api_LogEbook');
Route::middleware('auth:api')->post('/log/games','GamesController@api_LogGames');
Route::middleware('auth:api')->post('/log/task','TaskMasterController@api_LogTask');

/*DARI LAYNDO*/
Route::middleware('auth:api')->get('/siswa/nggarap','TaskMasterController@api_nilai');
