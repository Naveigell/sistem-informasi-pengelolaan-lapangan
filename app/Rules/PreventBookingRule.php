<?php

namespace App\Rules;

use App\Traits\Lapangan\HasBookingCourt;
use Illuminate\Contracts\Validation\Rule;

class PreventBookingRule implements Rule
{
    use HasBookingCourt;

    private $bookings;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(int $lapangan_id, array $times = [], string $date = null, string $jenis_sewa = 'reguler')
    {
        $this->bookings = $this->getBookingCourt($lapangan_id, $times, $date, $jenis_sewa);
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
