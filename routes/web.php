<?php

use App\Http\Controllers\JenisPermohonanController;
use App\Http\Controllers\LayananPermohonanController;
use App\Http\Controllers\PpatController;
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
    return view('welcome');
});

Route::get('/home', function () {
    return view('layouts.master');
});

Route::get('/dashboard', function () {
    return view('pages.dashboard.index');
});

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

Route::controller(PpatController::class)->prefix('ppat')->group(function () {
    Route::get('/', 'index')->name('ppat.index');
    Route::get('/pilih-layanan', 'selectLayanan')->name('ppat.layanan');
    Route::get('/create', 'create')->name('ppat.create');
    Route::post('/create/store', 'store')->name('ppat.store');
    Route::get('/{ppat}', 'show')->name('ppat.show');
    Route::get('/edit/{ppat}', 'edit')->name('ppat.edit');
    Route::put('/update/{ppat}', 'update')->name('ppat.update');
    Route::delete('/destroy/{ppat}', 'destroy')->name('ppat.destroy');
});
