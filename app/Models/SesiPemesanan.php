<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SesiPemesanan extends Model
{
    use HasFactory;

    protected $fillable = [
        "pemesanan_id", "sesi_id"
    ];

    public function sesi()
    {
        return $this->belongsTo(Sesi::class);
    }

    public function pemesanan()
    {
        return $this->belongsTo(Pemesanan::class);
    }

    public function pemesananInThisMonth()
    {
        return $this->belongsTo(Pemesanan::class, 'pemesanan_id')->whereMonth('tanggal_sewa', now()->month)->whereYear('tanggal_sewa', now()->year);
    }
}
