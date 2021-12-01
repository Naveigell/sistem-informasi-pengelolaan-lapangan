<?php

namespace Database\Factories;

use App\Models\Lapangan;
use App\Models\Sesi;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Collection;

class SesiFactory extends Factory
{
    private $lapangans;
    private static $lapanganIndex = 0;
    private static $jamMulai = 8;

    protected $model = Sesi::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        if (self::$jamMulai > 18) {
            self::$jamMulai = 8;
            self::$lapanganIndex++;
        }

        return [
            "lapangan_id" => $this->lapangans[self::$lapanganIndex]->id,
            "nama_sesi"   => \Str::random(10),
            "jam_mulai"   => Carbon::createFromTime(self::$jamMulai)->toTimeString(),
            "jam_selesai" => Carbon::createFromTime(self::$jamMulai += 2)->toTimeString(),
        ];
    }

    public function __construct($count = null, ?Collection $states = null, ?Collection $has = null, ?Collection $for = null, ?Collection $afterMaking = null, ?Collection $afterCreating = null, $connection = null)
    {
        parent::__construct($count, $states, $has, $for, $afterMaking, $afterCreating, $connection);

        $this->lapangans = Lapangan::all();
    }
}
