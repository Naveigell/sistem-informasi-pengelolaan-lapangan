<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kas extends Model
{
    use HasFactory;

    protected $fillable = ["karyawan_id", "tanggal_transaksi", "jenis", "nilai", "keterangan"];

    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class);
    }

    public function setNilaiAttribute($value)
    {
        if ($this->attributes['jenis'] === 'kredit') {
            $this->attributes['nilai'] = $value;
        } else {
            $total = Pemesanan::query()->whereDate('tanggal_sewa', $this->attributes['tanggal_transaksi'])->whereStatus('paid')->sum('total_harga');

            $this->attributes['nilai'] = $total;
        }
    }
}
