<?php

namespace App\Rules;

use App\Models\Pemesanan;
use App\Traits\Lapangan\HasBookingCourt;
use DB;
use Illuminate\Contracts\Validation\Rule;

class PreventBookingRule implements Rule
{
    use HasBookingCourt;

    private $bookings;
    private $lapangan_id;
    private $date;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(int $lapangan_id, array $times = [], string $date = null, string $jenis_sewa = 'reguler')
    {
        $this->bookings    = $this->getBookingCourt($lapangan_id, $times, $date, $jenis_sewa);
        $this->lapangan_id = $lapangan_id;
        $this->date        = $date;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $havePemesanans = Pemesanan::query()->join('sesi_pemesanans', 'sesi_pemesanans.pemesanan_id', '=', 'pemesanans.id')
                                                ->join('sesis', 'sesis.id', '=', 'sesi_pemesanans.sesi_id')
                                                ->where('member_id', auth('member')->id())
                                                ->whereDate('pemesanans.tanggal_sewa', $this->date)
                                                ->where('sesis.lapangan_id', $this->lapangan_id)
                                                ->exists();

        if (!$havePemesanans) {
            return true;
        }

        return $this->bookings->count() === 0;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Lapangan sudah dibooking oleh orang lain';
    }

//    private function canBooked(int $lapangan_id, array $times = [], string $date = null, string $jenis_sewa = 'reguler')
//    {
//        $paids = Pemesanan::query()->join('sesi_pemesanans', 'sesi_pemesanans.pemesanan_id', '=', 'pemesanans.id')
//                                    ->join('sesis', 'sesis.id', '=', 'sesi_pemesanans.sesi_id')
//                                    ->where('member_id', auth('member')->id())
//                                    ->whereDate('pemesanans.tanggal_sewa', $date)
//                                    ->where('sesis.lapangan_id', $lapangan_id)
//                                    ->whereIn('pemesanans.status', [Pemesanan::STATUS_PAID]);
//
//        $opens = Pemesanan::query()->join('sesi_pemesanans', 'sesi_pemesanans.pemesanan_id', '=', 'pemesanans.id')
//                                    ->join('sesis', 'sesis.id', '=', 'sesi_pemesanans.sesi_id')
//                                    ->where('member_id', auth('member')->id())
//                                    ->whereDate('pemesanans.tanggal_sewa', $date)
//                                    ->where('sesis.lapangan_id', $lapangan_id)
//                                    ->whereIn('pemesanans.status', [Pemesanan::STATUS_OPEN]);
//
//        $cancels = Pemesanan::query()->join('sesi_pemesanans', 'sesi_pemesanans.pemesanan_id', '=', 'pemesanans.id')
//                                    ->join('sesis', 'sesis.id', '=', 'sesi_pemesanans.sesi_id')
//                                    ->where('member_id', auth('member')->id())
//                                    ->whereDate('pemesanans.tanggal_sewa', $date)
//                                    ->where('sesis.lapangan_id', $lapangan_id)
//                                    ->whereIn('pemesanans.status', [Pemesanan::STATUS_CANCEL]);
//
//        if ($jenis_sewa === 'event') {
//
//            // get total count of paids, opens and cancel
//            $paidsCount   = $paids->count();
//            $opensCount   = $opens->count();
//            $cancelsCount = $cancels->count();
//
//            if ($paidsCount === 0 && $opensCount === 0 && $cancelsCount === 0) {
//                return true;
//            }
//
//            if ($paidsCount > 0 || $opensCount > 0) {
//                return false;
//            }
//
//            return $cancelsCount > 0;
//        }
//
//        $isPaidFirstLooping   = true;
//        $isOpenFirstLooping   = true;
//        $isCancelFirstLooping = true;
//
//        $paids->where(function ($query) use (&$isPaidFirstLooping, $times) {
//            foreach ($times as $time) {
//                if ($isPaidFirstLooping) {
//                    $query->where(DB::raw('HOUR(sesis.jam_selesai)'), '>', $time)
//                        ->where(DB::raw('HOUR(sesis.jam_mulai)'), '<=', $time + 1);
//
//                    $isPaidFirstLooping = false;
//                } else {
//                    $query->orWhere(DB::raw('HOUR(sesis.jam_selesai)'), '>', $time)
//                        ->where(DB::raw('HOUR(sesis.jam_mulai)'), '<=', $time + 1);
//                }
//            }
//        });
//
//        $opens->where(function ($query) use (&$isOpenFirstLooping, $times) {
//            foreach ($times as $time) {
//                if ($isOpenFirstLooping) {
//                    $query->where(DB::raw('HOUR(sesis.jam_selesai)'), '>', $time)
//                        ->where(DB::raw('HOUR(sesis.jam_mulai)'), '<=', $time + 1);
//
//                    $isOpenFirstLooping = false;
//                } else {
//                    $query->orWhere(DB::raw('HOUR(sesis.jam_selesai)'), '>', $time)
//                        ->where(DB::raw('HOUR(sesis.jam_mulai)'), '<=', $time + 1);
//                }
//            }
//        });
//
//        $cancels->where(function ($query) use (&$isCancelFirstLooping, $times) {
//            foreach ($times as $time) {
//                if ($isCancelFirstLooping) {
//                    $query->where(DB::raw('HOUR(sesis.jam_selesai)'), '>', $time)
//                        ->where(DB::raw('HOUR(sesis.jam_mulai)'), '<=', $time + 1);
//
//                    $isCancelFirstLooping = false;
//                } else {
//                    $query->orWhere(DB::raw('HOUR(sesis.jam_selesai)'), '>', $time)
//                        ->where(DB::raw('HOUR(sesis.jam_mulai)'), '<=', $time + 1);
//                }
//            }
//        });
//
//        $paidsCount   = $paids->count();
//        $opensCount   = $opens->count();
//        $cancelsCount = $cancels->count();
//
//        if ($paidsCount === 0 && $opensCount === 0 && $cancelsCount === 0) {
//            return true;
//        }
//
//        if ($paidsCount > 0 || $opensCount > 0) {
//            return false;
//        }
//
//        return $cancelsCount > 0;
//    }
}
