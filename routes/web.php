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
Route::get('/masuk/klaim', 'masuk@klaim')->name('klaim');
Route::post('/masuk', 'masuk@masuk')->name('masukPost');

Route::post('/api/api/masuk/klaim/cekEmail', 'masuk@cekEmail');
Route::post('/api/api/masuk/klaim/cekKode', 'masuk@cekKode');
Route::post('/api/api/masuk/klaim/storePass', 'masuk@storePass');
Route::post('/api/api/masuk/klaim/tolak', 'masuk@tolak');


Route::get('/keluar', 'keluar@index')->name('keluar');

Route::get('/', 'index@index')->name('dashboard');

Route::get('/laporan', 'laporan@index')->name('laporan');
Route::get('/pemaspenge', 'pemaspenge@index')->name('pemaspenge');

Route::get('/anggota', 'anggota@index')->name('anggota');


// APIAPIAPIAPIAPIAPIAPIAPIAPIAPIAPIAPIAPPPPPPPPAPAPIAPIAPIPIA

// SUMMARYYYY
Route::get('/api/api/summary', 'summary@summary');
Route::get('/api/api/pemasukanPengeluaran', 'summary@pemasukanPengeluaran');

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
Route::post('/api/api/pemaspenge/poin/save', 'apiapi@savePoinLaporan');

// ANGGOTA
Route::get('/api/api/anggota/getDataAnggota', 'apiapi@getDataAnggota');
Route::post('/api/api/anggota/addDataAnggota', 'apiapi@addDataAnggota');
Route::post('/api/api/anggota/deleteDataAnggota', 'apiapi@deleteDataAnggota');
Route::get('/api/api/laporan/prepareEditAnggota/{a}', 'apiapi@prepareEditAnggota');

Route::post('/api/api/anggota/kodeKeamanan', 'apiapi@kodeKeamanan');
