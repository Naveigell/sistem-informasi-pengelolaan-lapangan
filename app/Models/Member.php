<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Member extends Authenticatable
{
    use HasFactory;

    public const ACTIVE   = 'aktif';
    public const INACTIVE = 'tidak aktif';

    protected $fillable = [
        "nama_member", "alamat_member", "hp", "email", "password", "status",
    ];

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = \Hash::make($value);
    }
}
