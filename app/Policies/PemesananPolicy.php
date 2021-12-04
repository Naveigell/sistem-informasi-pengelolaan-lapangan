<?php

namespace App\Policies;

use App\Models\Pemesanan;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PemesananPolicy
{
    use HandlesAuthorization;

    public function canCancel(?User $user, Pemesanan $pemesanan)
    {
        return $pemesanan->member_id === auth('member')->id() && in_array($pemesanan->status, ['open']);
    }
}
