<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Pemesanan
 * @package App\Models
 * @method static|Builder cancel()
 */
class Pemesanan extends Model
{
    use HasFactory;

    protected $fillable = [
        "karyawan_id", "lapangan_id", "member_id", "tanggal_sewa", "jenis_sewa",
        "total_harga", "batas_waktu", "status",
    ];

    public function member()
    {
        return $this->belongsTo(Member::class);
    }

    public function sesiPemesanan()
    {
        return $this->hasMany(SesiPemesanan::class);
    }

    /**
     * @param Builder $query
     */
    public function scopeCancel($query)
    {
        $query->where('id', $this->attributes['id'])->update([
            "status" => "cancel",
        ]);
    }
}
