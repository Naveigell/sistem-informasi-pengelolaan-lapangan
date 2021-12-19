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

Route::prefix('karyawan')->name('karyawan.')->middleware('should.karyawan')->group(function () {
    Route::resource('lapangans', \App\Http\Controllers\Karyawan\LapanganController::class);
    Route::get('/kas/print', [\App\Http\Controllers\Karyawan\KasController::class, 'print'])->name('kas.print');
    Route::resource('kas', \App\Http\Controllers\Karyawan\KasController::class);
    Route::resource('jadwals', \App\Http\Controllers\Karyawan\JadwalController::class)->except(['show']);
    Route::get('/jadwals/{pemesanan}/lapangan/{lapangan}/sesi/{sesi}', [\App\Http\Controllers\Karyawan\JadwalController::class, 'show'])->name('jadwals.show');
    Route::resource('members', \App\Http\Controllers\Karyawan\MemberController::class);
    Route::resource('pemesanans', \App\Http\Controllers\Karyawan\PemesananController::class);
    Route::resource('pembayarans', \App\Http\Controllers\Karyawan\PembayaranController::class);
    Route::resource('dashboard', \App\Http\Controllers\Karyawan\DashboardController::class);
    Route::get('/laporans/print', [\App\Http\Controllers\Karyawan\LaporanController::class, 'print'])->name('laporans.print');
    Route::resource('laporans', \App\Http\Controllers\Karyawan\LaporanController::class);
});

Route::resource('/', \App\Http\Controllers\HomeController::class);

Route::prefix('member/auth')->name('member.auth.')->group(function () {
    Route::view('/login', 'auth.member.login')->name('login.index');
    Route::post('/login', [\App\Http\Controllers\Auth\AuthMemberController::class, 'login'])->name('login.store');

    Route::view('/register', 'auth.member.register')->name('register.index');
    Route::post('/register', [\App\Http\Controllers\Auth\AuthMemberController::class, 'register'])->name('register.store');
});

Route::prefix('karyawan/auth')->name('karyawan.auth.')->group(function () {
    Route::view('/login', 'auth.karyawan.login')->name('login.index');
    Route::post('/login', [\App\Http\Controllers\Auth\AuthKaryawanController::class, 'login'])->name('login.store');
});

Route::prefix('member')->name('member.')->middleware('should.member')->group(function () {
    Route::post('/pemesanans/{lapangan}/confirm', [\App\Http\Controllers\Member\PemesananController::class, 'confirmation'])->name('pemesanans.confirm');
    Route::get('/pemesanans/{pemesanan}/detail', [\App\Http\Controllers\Member\PemesananController::class, 'detail'])->name('pemesanans.detail');
    Route::resource('pemesanans', \App\Http\Controllers\Member\PemesananController::class);
    Route::delete('/pemesanans/{pemesanan}/cancel', [\App\Http\Controllers\Member\PemesananController::class, 'cancel'])->name('pemesanans.cancel');
    Route::get('/pemesanans/{pemesanan}/history', [\App\Http\Controllers\Member\PemesananController::class, 'history'])->name('pemesanans.history');
    Route::resource('lapangans', \App\Http\Controllers\Member\LapanganController::class);
    Route::resource('pembayarans', \App\Http\Controllers\Member\PembayaranController::class);
    Route::resource('jadwals', \App\Http\Controllers\Member\JadwalController::class);
    Route::resource('akuns', \App\Http\Controllers\Member\AkunController::class);
    Route::put('/akuns/{akun}/password', [\App\Http\Controllers\Member\AkunController::class, 'updatePassword'])->name('akuns.update.password');
});

Route::get('/logout', function () {
    auth('karyawan')->logout();
    auth('member')->logout();

    return redirect('/');
})->name('logout');
