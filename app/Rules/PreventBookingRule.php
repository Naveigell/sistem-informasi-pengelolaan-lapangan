<?php

namespace App\Rules;

use App\Models\Pemesanan;
use App\Traits\Lapangan\HasBookingCourt;
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
}
