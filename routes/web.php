<?php

Route::get('/daftar', 'daftar@index')->name('daftar');
Route::post('/daftar', 'daftar@daftar')->name('daftarPost');

Route::get('/masuk', 'masuk@index')->name('masuk');
Route::get('/masuk/klaim', 'masuk@klaim')->name('klaim');
Route::post('/masuk', 'masuk@masuk')->name('masukPost');

Route::get('/keluar', 'keluar@index')->name('keluar');

Route::get('/', 'index@index')->name('dashboard');
Route::get('/laporan', 'laporan@index')->name('laporan');
Route::get('/pemaspenge', 'pemaspenge@index')->name('pemaspenge');
Route::get('/anggota', 'anggota@index')->name('anggota');


// APIAPIAPIAPIAPIAPIAPIAPIAPIAPIAPIAPIAPPPPPPPPAPAPIAPIAPIPIA

Route::group(['prefix' => '/api/api/'], function () {
    // SARANBUG
    Route::post('saranBug', 'apiapi@saranBug');
    Route::get('saranBug/show/{key}', 'apiapi@saranBugshow');

    // DASHBOARD ANGGOTA
    Route::get('dashboard/anggota/getDataLaporan', 'apiapi@getDataLaporanForAnggota');
    Route::get('dashboard/anggota/getDetailLaporan/{id}', 'apiapi@getDetailLaporanForAnggota');

    // AUTH
    Route::group(['prefix' => 'masuk/klaim'], function () {

        Route::post('cekEmail', 'masuk@cekEmail');
        Route::post('cekKode', 'masuk@cekKode');
        Route::post('storePass', 'masuk@storePass');
        Route::post('tolak', 'masuk@tolak');
    });

    // SUMMARYYYY
    Route::get('summary', 'summary@summary');
    Route::get('pemasukanPengeluaran', 'summary@pemasukanPengeluaran');

    // SALDO
    Route::group(['prefix' => 'saldo'], function () {

        Route::get('getSaldo', 'apiapi@getSaldo');
        Route::post('postSaldo', 'apiapi@postSaldo');
    });

    // LAPORAN
    Route::group(['prefix' => 'laporan'], function () {

        Route::get('getDataLaporan', 'apiapi@getDataLaporan');
        Route::post('deleteDataLaporan', 'apiapi@deleteDataLaporan');
        Route::post('addDataLaporan', 'apiapi@addDataLaporan');
        Route::get('prepareEditLaporan/{a}', 'apiapi@prepareEditLaporan');
        Route::post('editDataLaporan', 'apiapi@editDataLaporan');
        Route::post('terbit', 'apiapi@terbit');

        Route::get('loadDataLaporan', 'apiapi@loadDataLaporan');
    });

    // PEMASPENGE
    Route::group(['prefix' => 'pemaspenge'], function () {

        Route::get('laporan/{id}', 'apiapi@loadDetailLaporan');
        Route::post('poin', 'apiapi@poinLaporan');
        Route::post('poin/delete', 'apiapi@deletePoinLaporan');
        Route::post('poin/save', 'apiapi@savePoinLaporan');
    });

    // ANGGOTA
    Route::group(['prefix' => 'anggota'], function () {

        Route::get('getDataAnggota', 'apiapi@getDataAnggota');
        Route::post('addDataAnggota', 'apiapi@addDataAnggota');
        Route::post('deleteDataAnggota', 'apiapi@deleteDataAnggota');
        Route::get('prepareEditAnggota/{a}', 'apiapi@prepareEditAnggota');
        Route::post('editDataAnggota', 'apiapi@editDataAnggota');

        Route::post('kodeKeamanan', 'apiapi@kodeKeamanan');
    });
});
