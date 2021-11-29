<?php

namespace App\Http\Requests\Karyawan;

use Illuminate\Foundation\Http\FormRequest;

class KasRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "tanggal_transaksi" => "required|date",
            "jenis"             => "required|in:kredit,debit",
            "nilai"             => "required|integer|min:1",
            "keterangan"        => "required|string|min:5|max:300",
        ];
    }
}
