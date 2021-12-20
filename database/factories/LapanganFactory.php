<?php

namespace Database\Factories;

use App\Models\Lapangan;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\File;

class LapanganFactory extends Factory
{
    private static $increment = 1;

    protected $model = Lapangan::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $path = storage_path().'/app/public/images/lapangan';
        File::isDirectory($path) or File::makeDirectory($path, 0777, true, true);

        return [
            "nama_lapangan"      => "Lapangan " . self::$increment ++,
            "deskripsi_lapangan" => $this->faker->text,
            "harga_reguler"      => 60000,
            "harga_turnamen"     => 100000,
            "foto"               => $this->faker->image(storage_path('app/public/images/lapangan'), 640, 640, null, false),
            "status"             => "aktif"
        ];
    }
}
