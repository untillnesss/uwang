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

Route::get('/', 'index@index')->name('dashboard');

