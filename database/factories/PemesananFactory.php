<?php

namespace Database\Factories;

use App\Models\Karyawan;
use App\Models\Lapangan;
use App\Models\Member;
use App\Models\Pembayaran;
use App\Models\Pemesanan;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

class PemesananFactory extends Factory
{
    protected $model = Pemesanan::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $member   = Member::all()->random();
        $karyawan = Karyawan::all()->random();
        $lapangan = Lapangan::all()->random();

        $startTime = now()->subHours(Arr::random([8, 10, 12, 14, 16, 18]));

        $nominal = (10 ** mt_rand(3, 6)) * mt_rand(1, 5);

        return [
            "karyawan_id"        => $karyawan->id,
            "lapangan_id"        => $lapangan->id,
            "member_id"          => $member->id,
            "tanggal_sewa"       => now()->subDays(rand(-10, 10))->toDateString(),
            "jenis_sewa"         => Arr::random(['reguler', 'event']),
            "total_harga"        => $nominal,
            "status"             => Arr::random(['open', 'cancel', 'paid']),
        ];
    }
}
