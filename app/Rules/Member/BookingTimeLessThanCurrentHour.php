<?php

namespace App\Rules\Member;

use Carbon\Carbon;
use Illuminate\Contracts\Validation\Rule;

class BookingTimeLessThanCurrentHour implements Rule
{
    private $times;
    private $date;

    /**
     * Create a new rule instance.
     *
     * @param $times
     * @param $date
     */
    public function __construct($times, $date)
    {
        $this->times = $times;
        $this->date  = $date;
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
        // if booking date is greater than current date
        // mark as passed
        if (Carbon::parse($this->date)->gt(now())) {
            return true;
        }

        // count the times, if the request hour is more than
        // current hour, it mean passed
        return count(array_filter($this->times, function ($time) {
            return $time <= now()->hour;
        })) == 0 && (
            $this->date == now()->format('Y-m-d')
        );
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Ada jam yang tidak bisa dipilih karena sudah atau sedang berlangsung.';
    }
}
