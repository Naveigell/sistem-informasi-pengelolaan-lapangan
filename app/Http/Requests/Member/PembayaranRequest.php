<?php

namespace App\Http\Requests\Member;

use App\Models\Pemesanan;
use Illuminate\Foundation\Http\FormRequest;

class PembayaranRequest extends FormRequest
{
    public function authorize()
    {
        $pemesanan = Pemesanan::query()->find($this->get('pemesanan_id'));

        // if pemesanan not found
        if (!$pemesanan) {
            return false;
        }

        // if pemesananan not belongs to member
        if ($pemesanan->member_id !== auth('member')->id()) {
            return false;
        }

        return now()->lt($pemesanan->batas_waktu);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "nomor_rekening_pengirim" => "required|string|min:1|max:100",
            "bank_tujuan"             => "required|string|in:bca,bri",
            "bank_pengirim"           => "required|string|min:1|max:40",
            "bukti_transaksi"         => "required|image|mimes:png,jpg,jpeg|max:2048",
            "pemesanan_id"            => "required|integer|min:1",
        ];
    }
}
