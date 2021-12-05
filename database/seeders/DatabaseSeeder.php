<?php

namespace Database\Seeders;

use App\Models\Karyawan;
use App\Models\Kas;
use App\Models\Lapangan;
use App\Models\Member;
use App\Models\Pembayaran;
use App\Models\Pemesanan;
use App\Models\Penyewaan;
use App\Models\Sesi;
use App\Models\SesiPemesanan;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        Member::factory(10)->create();
        Lapangan::factory(5)->create();
        Karyawan::factory(10)->create();
        Kas::factory(20)->create();

        $staff = new Karyawan([
            "nama_pengguna"     => "staff",
            "alamat"            => "Jalan staff",
            "no_telp"           => "08932849123",
            "jabatan"           => "staff",
            "email"             => "staff@email.com",
            "username"          => "staff",
            "password"          => Hash::make(123456),
            "status"            => "aktif"
        ]);
        $staff->save();

        $pemilik = new Karyawan([
            "nama_pengguna"     => "pemilik",
            "alamat"            => "Jalan pemilik",
            "no_telp"           => "08932849123",
            "jabatan"           => "pemilik",
            "email"             => "pemilik@email.com",
            "username"          => "pemilik",
            "password"          => Hash::make(123456),
            "status"            => "aktif"
        ]);
        $pemilik->save();
//        Pemesanan::factory(20)->create();
//        Pembayaran::factory(20)->create();
//        Penyewaan::factory(20)->create();
//        Sesi::factory(Lapangan::query()->count() * ((20 - 8) / 2))->create();
//        SesiPemesanan::factory(30)->create();
    }
}
