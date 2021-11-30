<?php

namespace Database\Factories;

use App\Models\Karyawan;
use App\Models\Pembayaran;
use App\Models\Pemesanan;
use Illuminate\Database\Eloquent\Factories\Factory;

class PembayaranFactory extends Factory
{
    protected $model = Pembayaran::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $karyawan  = Karyawan::query()->where('jabatan', 'staff')->get()->random();

        return [
            "karyawan_id"        => $karyawan->id,
            "tanggal_pembayaran" => now()->subDays(rand(-10, 10))->toDateString(),
            "total_pembayaran"   => (10 ** mt_rand(3, 6)) * mt_rand(1, 5),
        ];
    }
}
