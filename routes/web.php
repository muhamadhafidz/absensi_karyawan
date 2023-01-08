<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return redirect()->route('login');
});

Auth::routes(['register' => false]);

Route::middleware(['auth'])->group(function() {

    Route::get('/dashboard', 'HomeController@index')->name('home');
    Route::put('/ubah-password/{id}', 'HomeController@update')->name('ubah-password');

    Route::get('/izin', 'IzinController@index')->name('izin.index');
    Route::post('/izin', 'IzinController@store')->name('izin.store');
    Route::delete('/izin/delete/{id}', 'IzinController@delete')->name('izin.delete');

    Route::get('/absensi', 'AbsensiController@index')->name('absensi.index');
    Route::post('/absensi/clockIn', 'AbsensiController@clockIn')->name('absensi.clockIn');
    Route::post('/absensi/clockOut', 'AbsensiController@clockOut')->name('absensi.clockOut');

    Route::get('/riwayat-penggajian', 'RiwayatPenggajianController@index')->name('riwayat-penggajian.index');
    
    Route::middleware(['IsAdmin'])->group( function() {

        Route::get('/approval-izin', 'ApprovalIzinController@index')->name('approval-izin.index');
        Route::post('/approval-izin/approve/{id}', 'ApprovalIzinController@approve')->name('approval-izin.approve');
        Route::post('/approval-izin/tolak/{id}', 'ApprovalIzinController@tolak')->name('approval-izin.tolak');

        Route::get('/penggajian', 'PenggajianController@index')->name('penggajian.index');
        Route::get('/penggajian/detail/{tanggal}', 'PenggajianController@detail')->name('penggajian.detail');
        Route::post('/penggajian/gaji', 'PenggajianController@gaji')->name('penggajian.gaji');

        Route::prefix('setting')->group(function() {
            Route::get('/master-jabatan', 'MasterJabatanController@index')->name('master-jabatan.index');
            Route::post('/master-jabatan', 'MasterJabatanController@store')->name('master-jabatan.store');
            Route::put('/master-jabatan/{id}', 'MasterJabatanController@update')->name('master-jabatan.update');
            Route::delete('/master-jabatan/delete/{id}', 'MasterJabatanController@delete')->name('master-jabatan.delete');
            
            Route::get('/master-divisi', 'MasterDivisiController@index')->name('master-divisi.index');
            Route::post('/master-divisi', 'MasterDivisiController@store')->name('master-divisi.store');
            Route::put('/master-divisi/{id}', 'MasterDivisiController@update')->name('master-divisi.update');
            Route::delete('/master-divisi/delete/{id}', 'MasterDivisiController@delete')->name('master-divisi.delete');

            Route::get('/master-personalia', 'MasterPersonaliaController@index')->name('master-personalia.index');
            Route::post('/master-personalia', 'MasterPersonaliaController@store')->name('master-personalia.store');
            Route::put('/master-personalia/{id}', 'MasterPersonaliaController@update')->name('master-personalia.update');
            Route::delete('/master-personalia/delete/{id}', 'MasterPersonaliaController@delete')->name('master-personalia.delete');

            Route::get('/master-user', 'MasterUserController@index')->name('master-user.index');
            Route::post('/master-user', 'MasterUserController@store')->name('master-user.store');
            Route::put('/master-user/{id}', 'MasterUserController@update')->name('master-user.update');
            Route::delete('/master-user/delete/{id}', 'MasterUserController@delete')->name('master-user.delete');
        });
    });
});

