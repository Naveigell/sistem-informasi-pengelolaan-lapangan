<?php

namespace App\Models;

use App\Traits\Image\ImageHandler;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;

class Pembayaran extends Model
{
    use HasFactory, ImageHandler;

    protected $fillable = [
        "karyawan_id", "pemesanan_id", "tanggal_pembayaran", "bukti_transaksi",
        "bank_tujuan", "bank_pengirim", "nomor_rekening_pengirim", "atas_nama_pengirim",
        "status", "total_pembayaran"
    ];

    protected $appends = [
        "bukti_transaksi_url"
    ];

    /**
     * @param UploadedFile $file
     */
    public function setBuktiTransaksiAttribute($file)
    {
        if (is_uploaded_file($file)) {
            $this->attributes['bukti_transaksi'] = $this->uploadImage($file);
        } else {
            $this->attributes['bukti_transaksi'] = $file;
        }
    }

    public function getBuktiTransaksiUrlAttribute(): string
    {
        return asset('storage/images/bukti-transaksi/' . $this->bukti_transaksi);
    }

    public function pemesanan()
    {
        return $this->belongsTo(Pemesanan::class);
    }

    private function uploadedPath(): string
    {
        return '/public/images/bukti-transaksi';
    }
}
