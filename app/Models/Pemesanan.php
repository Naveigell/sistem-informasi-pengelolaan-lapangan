<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemesanan extends Model
{
    use HasFactory;

    protected $fillable = [
        "karyawan_id", "lapangan_id", "member_id", "tanggal_sewa", "jenis_sewa", "total_harga", "status",
    ];

    public function member()
    {
        return $this->belongsTo(Member::class);
    }

    public function lapangan()
    {
        return $this->belongsTo(Lapangan::class);
    }

    public function sesiPemesanan()
    {
        return $this->hasMany(SesiPemesanan::class);
    }
}
