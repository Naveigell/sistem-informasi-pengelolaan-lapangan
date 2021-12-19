<?php

namespace Database\Factories;

use App\Models\Karyawan;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;

class KaryawanFactory extends Factory
{
    protected $model = Karyawan::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "nama_pengguna"     => $this->faker->name,
            "alamat"            => $this->faker->streetAddress,
            "no_telp"           => $this->faker->numerify('08##########'),
            "jabatan"           => Arr::random(['staff', 'pemilik']),
            "email"             => $this->faker->unique->email,
            "username"          => $this->faker->unique->userName,
            "password"          => 123456,
            "status"            => "aktif"
        ];
    }
}
