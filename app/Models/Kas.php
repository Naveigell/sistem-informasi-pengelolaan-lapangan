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
}
