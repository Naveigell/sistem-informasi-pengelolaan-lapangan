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

    protected $appends = [
        "valid_count", "waiting_count", "invalid_count"
    ];

    public function member()
    {
        return $this->belongsTo(Member::class);
    }

    public function sesiPemesanan()
    {
        return $this->hasMany(SesiPemesanan::class);
    }

    public function getValidCountAttribute()
    {
        return $this->hasMany(Pembayaran::class)->where('status', 'valid')->count();
    }

    public function getWaitingCountAttribute()
    {
        return $this->hasMany(Pembayaran::class)->whereNull('status')->count();
    }

    public function getInvalidCountAttribute()
    {
        return $this->hasMany(Pembayaran::class)->where('status', 'invalid')->count();
    }

    /**
     * @param Builder $query
     */
    public function scopePaid($query)
    {
        $query->where('id', $this->attributes['id'])->update([
            "status" => "paid",
        ]);
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
