<?php

use App\Http\Controllers\ArsipNotarisController;
use App\Http\Controllers\ArsipPpatController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BiayaPermohonanController;
use App\Http\Controllers\BiayaTambahanController;
use App\Http\Controllers\BiayaTambahanNotarisController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\JenisPermohonanController;
use App\Http\Controllers\LayananPermohonanController;
use App\Http\Controllers\NotarisController;
use App\Http\Controllers\PpatController;
use App\Http\Controllers\ReportNotarisController;
use App\Http\Controllers\ReportPpatController;
use App\Http\Controllers\UserController;
use App\Models\BiayaTambahanNotaris;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect('/dashboard');
});

// Route::get('/home', function () {
//     return view('layouts.master');
// });
Route::controller(AuthController::class)->prefix('auth')->group(function () {
    Route::get('/register', 'showRegister')->name('register');
    Route::post('/register', 'register')->name('register.post');
    Route::get('/login', 'showLogin')->name('login');
    Route::post('/login', 'login')->name('login.post');
    Route::get('/logout', 'logout')->name('logout');
});


Route::group(['middleware' => 'auth'], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');



    Route::controller(JenisPermohonanController::class)->prefix('permohonan')->group(function () {
        Route::get('/', 'index')->name('permohonan.index');
        Route::get('/create', 'create')->name('permohonan.create');
        Route::post('/store', 'store')->name('permohonan.store');
        Route::get('/{jenisPermohonan}', 'show')->name('permohonan.show');
        Route::get('/edit/{jenisPermohonan}', 'edit')->name('permohonan.edit');
        Route::put('/update/{jenisPermohonan}', 'update')->name('permohonan.update');
        Route::delete('/destroy/{jenisPermohonan}', 'destroy')->name('permohonan.destroy');
    });

    Route::controller(LayananPermohonanController::class)->prefix('layanan')->group(function () {
        Route::get('/', 'index')->name('layanan.index');
        Route::get('/create', 'create')->name('layanan.create');
        Route::post('/store', 'store')->name('layanan.store');
        Route::get('/{layananPermohonan}', 'show')->name('layanan.show');
        Route::get('/edit/{layananPermohonan}', 'edit')->name('layanan.edit');
        Route::put('/update/{layananPermohonan}', 'update')->name('layanan.update');
        Route::delete('/destroy/{layananPermohonan}', 'destroy')->name('layanan.destroy');
    });

    Route::controller(BiayaPermohonanController::class)->prefix('biaya')->group(function () {
        Route::get('/', 'index')->name('biaya.index');
        Route::get('/create', 'create')->name('biaya.create');
        Route::post('/store', 'store')->name('biaya.store');
        Route::get('/{id}', 'show')->name('biaya.show');
        Route::get('/edit/{biayaPermohonan}', 'edit')->name('biaya.edit');
        Route::put('/update/{biayaPermohonan}', 'update')->name('biaya.update');
        Route::delete('/destroy/{biayaPermohonan}', 'destroy')->name('biaya.destroy');
    });

    Route::controller(PpatController::class)->prefix('ppat')->group(function () {
        Route::get('/', 'index')->name('ppat.index');
        Route::get('/index2', 'index2')->name('ppat.index2');
        Route::get('/index3', 'index3')->name('ppat.index3');
        Route::get('/index4', 'index4')->name('ppat.index4');

        Route::get('/reject/{ppat}', 'reject')->name('ppat.reject');
        Route::get('/confirm/{ppat}', 'confirm')->name('ppat.confirm');
        Route::get('/verifikasi/{ppat}', 'verifikasi')->name('ppat.verifikasi');
        Route::get('/finish/{ppat}', 'finish')->name('ppat.finish');

        Route::get('/pembayaran/{ppat}', 'pembayaranLayanan')->name('ppat.pembayaran');

        Route::get('/pembayaran-tambahan/{ppat}', 'pembayaranTambahan')->name('ppat.pembayaran-tambahan');

        Route::get('/cetak-ppat/{ppat}', 'cetakPPAT')->name('ppat.cetak');

        Route::get('/pilih-layanan', 'selectLayanan')->name('ppat.layanan');
        Route::get('/create', 'create')->name('ppat.create');
        Route::post('/download', 'download')->name('ppat.download');
        Route::post('/create/store', 'store')->name('ppat.store');
        Route::get('/{ppat}', 'show')->name('ppat.show');
        Route::get('/edit/{ppat}', 'edit')->name('ppat.edit');
        Route::put('/update/{ppat}', 'update')->name('ppat.update');
        Route::delete('/destroy/{ppat}', 'destroy')->name('ppat.destroy');
        Route::get('/reject/{ppat}', 'destroy')->name('ppat.reject');
    });

    Route::controller(NotarisController::class)->prefix('notaris')->group(function () {

        Route::get('/', 'index')->name('notaris.index');
        Route::get('/index2', 'index2')->name('notaris.index2');
        Route::get('/index3', 'index3')->name('notaris.index3');
        Route::get('/index4', 'index4')->name('notaris.index4');
        Route::get('/pilih-layanan', 'selectLayanan')->name('notaris.layanan');

        Route::get('/reject/{notaris}', 'reject')->name('notaris.reject');
        Route::get('/confirm/{notaris}', 'confirm')->name('notaris.confirm');
        Route::get('/verifikasi/{notaris}', 'verifikasi')->name('notaris.verifikasi');
        Route::get('/finish/{notaris}', 'finish')->name('notaris.finish');

        Route::get('/pembayaran/{notaris}', 'pembayaranLayanan')->name('notaris.pembayaran');
        Route::get('/pembayaran-tambahan/{notaris}', 'pembayaranTambahan')->name('notaris.pembayaran-tambahan');

        Route::post('/download', 'download')->name('notaris.download');

        Route::get('/cetak-notaris/{notaris}', 'cetakNotaris')->name('notaris.cetak');

        Route::get('/create', 'create')->name('notaris.create');
        Route::post('/store', 'store')->name('notaris.store');
        Route::get('/{notaris}', 'show')->name('notaris.show');
        Route::get('/edit/{notaris}', 'edit')->name('notaris.edit');
        Route::put('/update/{notaris}', 'update')->name('notaris.update');
        Route::delete('/destroy/{notaris}', 'destroy')->name('notaris.destroy');
        Route::get('/reject/{notaris}', 'destroy')->name('notaris.reject');
    });

    Route::controller(ArsipPpatController::class)->prefix('arsip-ppat')->group(function () {
        Route::get('/', 'index')->name('arsip-ppat.index');
        Route::get('/create/{id?}', 'create')->name('arsip-ppat.create');
        Route::post('/store', 'store')->name('arsip-ppat.store');
        Route::get('/{arsipPpat}', 'show')->name('arsip-ppat.show');
        Route::get('/edit/{arsipPpat}', 'edit')->name('arsip-ppat.edit');
        Route::put('/update/{arsipPpat}', 'update')->name('arsip-ppat.update');
        Route::delete('/destroy/{arsipPpat}', 'destroy')->name('arsip-ppat.destroy');

        Route::post('/download', 'download')->name('arsip-ppat.download');
    });

    Route::controller(ArsipNotarisController::class)->prefix('arsip-notaris')->group(function () {
        Route::get('/', 'index')->name('arsip-notaris.index');
        Route::get('/create/{id?}', 'create')->name('arsip-notaris.create');
        Route::post('/store', 'store')->name('arsip-notaris.store');
        Route::get('/{arsipNotaris}', 'show')->name('arsip-notaris.show');
        Route::get('/edit/{arsipNotaris}', 'edit')->name('arsip-notaris.edit');
        Route::put('/update/{arsipNotaris}', 'update')->name('arsip-notaris.update');
        Route::delete('/destroy/{arsipNotaris}', 'destroy')->name('arsip-notaris.destroy');

        Route::post('/download', 'download')->name('arsip-notaris.download');
    });

    Route::controller(BiayaTambahanController::class)->prefix('biaya-tambahan')->group(function () {
        Route::get('/', 'index')->name('biaya-tambahan.index');
        Route::get('/create', 'create')->name('biaya-tambahan.create');
        Route::post('/store', 'store')->name('biaya-tambahan.store');
        Route::get('/{biayaTambahan}', 'show')->name('biaya-tambahan.show');
        Route::get('/edit/{biayaTambahan}', 'edit')->name('biaya-tambahan.edit');
        Route::put('/update/{biayaTambahan}', 'update')->name('biaya-tambahan.update');
        Route::get('/destroy/{biayaTambahan}', 'destroy')->name('biaya-tambahan.destroy');
    });

    Route::controller(BiayaTambahanNotarisController::class)->prefix('biaya-tambahan-notaris')->group(function () {
        Route::get('/', 'index')->name('biaya-tambahan-notaris.index');
        Route::get('/create', 'create')->name('biaya-tambahan-notaris.create');
        Route::post('/store', 'store')->name('biaya-tambahan-notaris.store');
        Route::get('/{biayaTambahanNotaris}', 'show')->name('biaya-tambahan-notaris.show');
        Route::get('/edit/{biayaTambahanNotaris}', 'edit')->name('biaya-tambahan-notaris.edit');
        Route::put('/update/{biayaTambahanNotaris}', 'update')->name('biaya-tambahan-notaris.update');
        Route::get('/destroy/{biayaTambahanNotaris}', 'destroy')->name('biaya-tambahan-notaris.destroy');
    });

    Route::controller(UserController::class)->prefix('user')->group(function () {
        Route::get('/', 'index')->name('user.index');
        Route::get('/create', 'create')->name('user.create');
        Route::post('/store', 'store')->name('user.store');
        Route::get('/edit/{user}', 'edit')->name('user.edit');
        Route::put('/update/{user}', 'update')->name('user.update');
        Route::delete('/destroy/{user}', 'destroy')->name('user.destroy');
        Route::get('/reset-password/{user}', 'resetPassword')->name('user.reset-password');
        Route::get('/ubah-password', 'ubahPassword')->name('user.ubah-password');
        Route::patch('/update-password/{user}', 'updatePassword')->name('user.update-password');
    });

    Route::controller(ReportPpatController::class)->prefix('report-ppat')->group(function () {
        Route::get('/', 'index')->name('report-ppat.index');
        Route::post('/cetak', 'print')->name('report-ppat.cetak');
    });

    Route::controller(ReportNotarisController::class)->prefix('report-notaris')->group(function () {
        Route::get('/', 'index')->name('report-notaris.index');
        Route::post('/cetak', 'print')->name('report-notaris.cetak');
    });
});
