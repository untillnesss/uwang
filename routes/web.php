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
Route::get('/daftar', 'daftar@index')->name('daftar');
Route::post('/daftar', 'daftar@daftar')->name('daftarPost');

Route::get('/masuk', 'masuk@index')->name('masuk');
Route::post('/masuk', 'masuk@masuk')->name('masukPost');


Route::get('/keluar', 'keluar@index')->name('keluar');

Route::get('/', 'index@index')->name('dashboard');

Route::get('/laporan', 'laporan@index')->name('laporan');
Route::get('/pemaspenge', 'pemaspenge@index')->name('pemaspenge');


// APIAPIAPIAPIAPIAPIAPIAPIAPIAPIAPIAPIAPPPPPPPPAPAPIAPIAPIPIA

// SALDO
Route::get('/api/api/saldo/getSaldo', 'apiapi@getSaldo');
Route::post('/api/api/saldo/postSaldo', 'apiapi@postSaldo');

// LAPORAN
Route::get('/api/api/laporan/getDataLaporan', 'apiapi@getDataLaporan');
Route::post('/api/api/laporan/deleteDataLaporan', 'apiapi@deleteDataLaporan');
Route::post('/api/api/laporan/addDataLaporan', 'apiapi@addDataLaporan');
Route::get('/api/api/laporan/prepareEditLaporan/{a}', 'apiapi@prepareEditLaporan');
Route::post('/api/api/laporan/editDataLaporan', 'apiapi@editDataLaporan');

Route::get('/api/api/laporan/loadDataLaporan', 'apiapi@loadDataLaporan');

// PEMASPENGE
Route::get('/api/api/pemaspenge/laporan/{id}', 'apiapi@loadDetailLaporan');
Route::post('/api/api/pemaspenge/poin', 'apiapi@poinLaporan');
Route::post('/api/api/pemaspenge/poin/delete', 'apiapi@deletePoinLaporan');
