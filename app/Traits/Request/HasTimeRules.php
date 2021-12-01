<?php


namespace App\Traits\Request;


use App\Rules\PreventBookingRule;

trait HasTimeRules
{
    private function createTimeRules(array &$rules)
    {
        if (request()->get('jenis_sewa') === "reguler") {
            $rules["booked"] = [new PreventBookingRule($this->get('id'), $this->get('waktu') ?? [], $this->get('tanggal'))];
        } else {
            $rules["booked"] = [new PreventBookingRule($this->get('id'), [], $this->get('tanggal'), 'event')];
        }
    }
}
