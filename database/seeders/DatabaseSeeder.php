<?php

namespace Database\Seeders;

use App\Models\Karyawan;
use App\Models\Kas;
use App\Models\Lapangan;
use App\Models\Member;
use App\Models\Pembayaran;
use App\Models\Pemesanan;
use App\Models\Penyewaan;
use Illuminate\Database\Seeder;

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
        Pemesanan::factory(20)->create();
        Pembayaran::factory(20)->create();
        Penyewaan::factory(20)->create();
    }
}
