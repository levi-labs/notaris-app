<?php

use App\Http\Controllers\ArsipPpatController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BiayaPermohonanController;
use App\Http\Controllers\BiayaTambahanController;
use App\Http\Controllers\JenisPermohonanController;
use App\Http\Controllers\LayananPermohonanController;
use App\Http\Controllers\PpatController;
use App\Http\Controllers\UserController;
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
    Route::get('/register', 'register')->name('register');
    Route::post('/register', 'store')->name('register.post');
    Route::get('/login', 'showLogin')->name('login');
    Route::post('/login', 'login')->name('login.post');
    Route::get('/logout', 'logout')->name('logout');
});


Route::group(['middleware' => 'auth'], function () {
    Route::get('/dashboard', function () {
        return view('pages.dashboard.index');
    })->name('dashboard');

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

        Route::get('/pilih-layanan', 'selectLayanan')->name('ppat.layanan');
        Route::get('/create', 'create')->name('ppat.create');
        Route::post('/download', 'download')->name('ppat.download');
        Route::post('/create/store', 'store')->name('ppat.store');
        Route::get('/{ppat}', 'show')->name('ppat.show');
        Route::get('/edit/{ppat}', 'edit')->name('ppat.edit');
        Route::put('/update/{ppat}', 'update')->name('ppat.update');
        Route::delete('/destroy/{ppat}', 'destroy')->name('ppat.destroy');
    });

    Route::controller(ArsipPpatController::class)->prefix('arsip-ppat')->group(function () {
        Route::get('/', 'index')->name('arsip-ppat.index');
        Route::get('/create/{id}', 'create')->name('arsip-ppat.create');
        Route::post('/store', 'store')->name('arsip-ppat.store');
        Route::get('/{arsipPpat}', 'show')->name('arsip-ppat.show');
        Route::get('/edit/{arsipPpat}', 'edit')->name('arsip-ppat.edit');
        Route::put('/update/{arsipPpat}', 'update')->name('arsip-ppat.update');
        Route::delete('/destroy/{arsipPpat}', 'destroy')->name('arsip-ppat.destroy');
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

    Route::controller(UserController::class)->prefix('user')->group(function () {
        Route::get('/', 'index')->name('user.index');
        Route::get('/create', 'create')->name('user.create');
        Route::post('/store', 'store')->name('user.store');
        Route::get('/edit/{user}', 'edit')->name('user.edit');
        Route::put('/update/{user}', 'update')->name('user.update');
        Route::delete('/destroy/{user}', 'destroy')->name('user.destroy');
        Route::get('/reset-password/{user}', 'resetPassword')->name('user.reset-password');
    });
});
