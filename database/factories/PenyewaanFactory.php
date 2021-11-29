<?php

namespace Database\Factories;

use App\Models\Karyawan;
use App\Models\Pembayaran;
use App\Models\Penyewaan;
use Illuminate\Database\Eloquent\Factories\Factory;

class PenyewaanFactory extends Factory
{
    protected $model = Penyewaan::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $karyawan = Karyawan::all()->random();
        $pembayaran = Pembayaran::all()->random();

        return [
            "karyawan_id"   => $karyawan->id,
            "pembayaran_id" => $pembayaran->id,
            "status_guna"   => \Arr::random(['datang', 'tidak datang']),
            "status_sewa"   => \Arr::random(['on going', 'done']),
        ];
    }
}
