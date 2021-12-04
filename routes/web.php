<?php

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

Route::prefix('karyawan')->name('karyawan.')->group(function () {
    Route::resource('lapangans', \App\Http\Controllers\Karyawan\LapanganController::class);
    Route::get('/kas/print', [\App\Http\Controllers\Karyawan\KasController::class, 'print'])->name('kas.print');
    Route::resource('kas', \App\Http\Controllers\Karyawan\KasController::class);
    Route::resource('jadwals', \App\Http\Controllers\Karyawan\JadwalController::class);
    Route::resource('members', \App\Http\Controllers\Karyawan\MemberController::class);
    Route::resource('pemesanans', \App\Http\Controllers\Karyawan\PemesananController::class);
    Route::resource('pembayarans', \App\Http\Controllers\Karyawan\PembayaranController::class);
    Route::resource('dashboard', \App\Http\Controllers\Karyawan\DashboardController::class);
});

Route::resource('/', \App\Http\Controllers\HomeController::class);

Route::prefix('member/auth')->name('member.auth.')->group(function () {
    Route::view('/login', 'auth.member.login')->name('login.index');
    Route::post('/login', [\App\Http\Controllers\Auth\AuthMemberController::class, 'login'])->name('login.store');
});

Route::prefix('karyawan/auth')->name('karyawan.auth.')->group(function () {
    Route::view('/login', 'auth.karyawan.login')->name('login.index');
    Route::post('/login', [\App\Http\Controllers\Auth\AuthKaryawanController::class, 'login'])->name('login.store');
});

Route::prefix('member')->name('member.')->group(function () {
    Route::post('/pemesanans/{lapangan}/confirm', [\App\Http\Controllers\Member\PemesananController::class, 'confirmation'])->name('pemesanans.confirm');
    Route::resource('pemesanans', \App\Http\Controllers\Member\PemesananController::class);
    Route::delete('/pemesanans/{pemesanan}/cancel', [\App\Http\Controllers\Member\PemesananController::class, 'cancel']);
    Route::resource('lapangans', \App\Http\Controllers\Member\LapanganController::class);
    Route::resource('pembayarans', \App\Http\Controllers\Member\PembayaranController::class);
    Route::resource('akuns', \App\Http\Controllers\Member\AkunController::class);
});

Route::get('/logout', function () {
    auth('karyawan')->logout();
    auth('member')->logout();

    return redirect('/');
})->name('logout');
