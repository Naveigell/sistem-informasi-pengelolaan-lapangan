<?php

namespace Database\Factories;

use App\Models\Pemesanan;
use App\Models\Sesi;
use Illuminate\Database\Eloquent\Factories\Factory;

class SesiPemesananFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "pemesanan_id" => Pemesanan::all()->random()->id,
            "sesi_id"      => Sesi::all()->random()->id,
        ];
    }
}
