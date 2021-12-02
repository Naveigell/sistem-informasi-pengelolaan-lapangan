<?php

namespace App\Http\Requests\Member;

use Illuminate\Foundation\Http\FormRequest;

class PembayaranRequest extends FormRequest
{
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
