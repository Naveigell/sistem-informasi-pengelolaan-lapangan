<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class Lapangan extends Model
{
    use HasFactory;

    protected $fillable = ["nama_lapangan", "deskripsi_lapangan", "harga_reguler", "harga_turnamen", "foto"];

    protected $appends = [
        'foto_url'
    ];

    public function getFotoUrlAttribute(): ?string
    {
        return asset('storage/images/lapangan/' . $this->foto);
    }

    /**
     * @param UploadedFile $value
     */
    public function setFotoAttribute($value)
    {
        $name = $value;

        if (is_uploaded_file($value)) {
            $name = Str::uuid() . '.' . $value->getClientOriginalExtension();

            Storage::putFileAs('/public/images/lapangan', $value, $name);
        }

        $this->attributes['foto'] = $name;
    }

    public function sesis()
    {
        return $this->hasMany(Sesi::class);
    }
}
