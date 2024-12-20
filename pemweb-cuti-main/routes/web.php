<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin;
use App\Http\Controllers\Pegawai;

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

Route::get('/', [HomeController::class, 'index']);

Route::prefix('admin')->group(function () {
    Route::controller(Admin\AuthController::class)->group(function () {
        Route::get('/login', 'loginHTML')->name('admin.login');
        Route::post('/login', 'loginSESS');
        Route::get('/logout', 'logoutSESS')->middleware('auth:admin')->name('admin.logout');
    });

    Route::controller(Admin\DashboardController::class)->group(function () {
        Route::get('/dashboard', 'indexHTML')->middleware('auth:admin')->name('admin.dashboard');
    });

    Route::middleware('auth:admin')->group(function () {
        Route::group([
            'prefix' => 'pegawai',
            'controller' => Admin\PegawaiController::class
        ], function () {
            Route::get('/tambah', 'tambahPegawaiHTML')->name('admin.pegawai.tambah');
            Route::post('/tambah', 'tambahPegawaiDB');

            Route::get('/list', 'listPegawaiHTML')->name('admin.pegawai.list');

            Route::get('/edit/{pegawai}', 'editPegawaiHTML')->name('admin.pegawai.edit');
            Route::post('/edit/{pegawai}', 'editPegawaiDB');

            Route::get('/hapus/{pegawai}', 'hapusPegawaiDB')->name('admin.pegawai.hapus');
        });

        Route::group([
            'prefix' => 'cuti',
            'controller' => Admin\Cuti\BuatController::class
        ], function () {
            Route::get('/buat', 'buatCutiHTML')->name('admin.cuti.buat');
            Route::post('/buat', 'buatCutiDB');
        });

        Route::group([
            'prefix' => 'cuti',
            'controller' => Admin\CutiController::class
        ], function () {
            Route::get('/list', 'listCutiHTML')->name('admin.cuti.list');

            Route::get('/detail/{cuti}', 'detailCutiHTML')->name('admin.cuti.detail');
            Route::get('/detail/{cuti}/buktipengajuan', 'detailCutiBuktipengajuanPDF')->name('admin.cuti.detail.buktipengajuan');
            Route::get('/detail/{cuti}/suratizin', 'detailCutiSuratizinPDF')->name('admin.cuti.detail.suratizin');

            Route::get('/approve/{cuti}', 'approveCutiDB')->name('admin.cuti.approve');
            Route::get('/reject/{cuti}', 'rejectCutiDB')->name('admin.cuti.reject');
        });

        Route::group([
            'prefix' => 'perusahaan',
            'controller' => Admin\PerusahaanController::class
        ], function () {
            Route::get('/identitas', 'identitasPerusahaanHTML')->name('admin.perusahaan.identitas');
            Route::post('/identitas', 'identitasPerusahaanDB');

            Route::get('/logo', 'logoPerusahaanHTML')->name('admin.perusahaan.logo');
            Route::get('/logo/img', 'logoPerusahaanIMG')->name('admin.perusahaan.logo.img');
            Route::post('/logo', 'logoPerusahaanDB');

            Route::get('/pejabat', 'pejabatPerusahaanHTML')->name('admin.perusahaan.pejabat');
            Route::post('/pejabat', 'pejabatPerusahaanDB');
        });
    });
});

Route::prefix('pegawai')->group(function() {
    Route::controller(Pegawai\AuthController::class)->group(function () {
        Route::get('/login', 'loginHTML')->name('pegawai.login');
        Route::post('/login', 'loginSESS');
        Route::get('/logout', 'logoutSESS')->middleware('auth:pegawai')->name('pegawai.logout');
    });

    Route::controller(Pegawai\DashboardController::class)->group(function () {
        Route::get('/dashboard', 'indexHTML')->middleware('auth:pegawai')->name('pegawai.dashboard');
    });

    Route::middleware('auth:pegawai')->group(function () {
        Route::group([
            'prefix' => 'cuti',
            'controller' => Pegawai\CutiController::class
        ], function () {
            Route::get('/ajukan', 'ajukanCutiHTML')->name('pegawai.cuti.ajukan');
            Route::post('/ajukan', 'ajukanCutiDB');

            Route::get('/riwayat', 'riwayatCutiHTML')->name('pegawai.cuti.riwayat');

            Route::get('/status/{cuti}', 'statusCutiHTML')->name('pegawai.cuti.status');
            Route::get('/status/{cuti}/buktipengajuan', 'statusCutiBuktipengajuanPDF')->name('pegawai.cuti.status.buktipengajuan');
            Route::get('/status/{cuti}/suratizin', 'statusCutiSuratizinPDF')->name('pegawai.cuti.status.suratizin');
        });
    });
});

