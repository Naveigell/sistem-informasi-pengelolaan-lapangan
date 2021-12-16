<?php

namespace Database\Factories;

use App\Models\Karyawan;
use App\Models\Kas;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

class KasFactory extends Factory
{
    protected $model = Kas::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $karyawan = Karyawan::query()->where('jabatan', 'staff')->get()->random();

        return [
            "karyawan_id"       => $karyawan->id,
            "tanggal_transaksi" => now()->subDays(mt_rand(5, 10))->toDate(),
            "jenis"             => Arr::random(['debit', 'kredit']),
            "nilai"             => (10 ** mt_rand(3, 6)) * mt_rand(1, 5),
            "keterangan"        => $this->faker->realText,
        ];
    }
}
