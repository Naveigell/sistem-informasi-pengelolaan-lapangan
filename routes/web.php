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
    Route::resource('kas', \App\Http\Controllers\Karyawan\KasController::class);
    Route::resource('members', \App\Http\Controllers\Karyawan\MemberController::class);
    Route::resource('pemesanans', \App\Http\Controllers\Karyawan\PemesananController::class);
    Route::resource('pembayarans', \App\Http\Controllers\Karyawan\PembayaranController::class);
});

Route::resource('/', \App\Http\Controllers\HomeController::class);

Route::prefix('member/auth')->name('member.auth.')->group(function () {
    Route::view('/login', 'auth.member.login')->name('login.index');
    Route::post('/login', [\App\Http\Controllers\Auth\AuthMemberController::class, 'login'])->name('login.store');
});

Route::prefix('member')->name('member.')->group(function () {
    Route::resource('lapangans', \App\Http\Controllers\Member\LapanganController::class);
    Route::post('/pemesanans/{lapangan}/confirm', [\App\Http\Controllers\Member\PemesananController::class, 'confirmation'])->name('pemesanans.confirm');
    Route::resource('pemesanans', \App\Http\Controllers\Member\PemesananController::class);
});

Route::get('/logout', function () {
    auth('karyawan')->logout();
    auth('member')->logout();
})->name('logout');
