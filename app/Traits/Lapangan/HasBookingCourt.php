<?php


namespace App\Traits\Lapangan;


use App\Models\Pemesanan;
use Illuminate\Support\Facades\DB;

trait HasBookingCourt
{
    // SAMPLE QUERY
    // SELECT * FROM `pemesanans`
    // INNER JOIN sesi_pemesanans ON sesi_pemesanans.pemesanan_id = pemesanans.id
    // INNER JOIN sesis ON sesis.id = sesi_pemesanans.sesi_id
    // WHERE pemesanans.tanggal_sewa = '2021-11-28' AND sesis.lapangan_id = 3;

    private function getBookingCourt(int $lapangan_id, array $times = [], string $date = null, string $jenis_sewa = 'reguler')
    {
        $query = Pemesanan::query()->join('sesi_pemesanans', 'sesi_pemesanans.pemesanan_id', '=', 'pemesanans.id')
                                   ->join('sesis', 'sesis.id', '=', 'sesi_pemesanans.sesi_id')
                                   ->whereDate('pemesanans.tanggal_sewa', $date)->where('sesis.lapangan_id', $lapangan_id);

        if ($jenis_sewa === 'event') {
            return $query->get();
        }

        $isFirstLooping = true;

        $query->where(function ($query) use (&$isFirstLooping, $times) {
            foreach ($times as $time) {
                if ($isFirstLooping) {
                    $query->where(DB::raw('HOUR(sesis.jam_selesai)'), '>', $time)
                          ->where(DB::raw('HOUR(sesis.jam_mulai)'), '<=', $time + 1);

                    $isFirstLooping = false;
                } else {
                    $query->orWhere(DB::raw('HOUR(sesis.jam_selesai)'), '>', $time)
                          ->where(DB::raw('HOUR(sesis.jam_mulai)'), '<=', $time + 1);
                }
            }
        });

        return $query->get();
    }
}
