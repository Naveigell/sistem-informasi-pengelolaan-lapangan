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
        $rules = [
            "tanggal_transaksi" => "required|date",
            "jenis"             => "required|in:kredit,debit",
            "keterangan"        => "required|string|min:5|max:300",
        ];

        if ($this->jenis === 'kredit') {
            $rules['nilai'] = "required|integer|min:1";
        }

        return $rules;
    }
}
