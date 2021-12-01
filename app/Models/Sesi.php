<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sesi extends Model
{
    use HasFactory;

    protected $fillable = [
        "nama_sesi", "jam_mulai", "jam_selesai", "lapangan_id",
    ];

    public function sesiPemesanan()
    {
        return $this->hasMany(SesiPemesanan::class);
    }
}
