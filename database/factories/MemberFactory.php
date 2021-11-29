<?php

namespace Database\Factories;

use App\Models\Member;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;

class MemberFactory extends Factory
{
    protected $model = Member::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "nama_member"       => $this->faker->name,
            "alamat_member"     => $this->faker->streetAddress,
            "hp"                => $this->faker->numerify('08##########'),
            "email"             => $this->faker->unique->safeEmail,
            "password"          => Hash::make(123456),
            "status"            => "aktif"
        ];
    }
}
