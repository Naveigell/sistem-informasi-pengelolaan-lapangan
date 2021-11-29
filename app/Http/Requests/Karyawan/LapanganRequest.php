<?php

namespace App\Http\Requests\Karyawan;

use Illuminate\Foundation\Http\FormRequest;

class LapanganRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "nama_lapangan"      => "required|string|min:3|max:50",
            "deskripsi_lapangan" => "required|string|min:3|max:2000",
            "harga_reguler"      => "required|integer|min:60000|max:5000000",
            "harga_turnamen"     => "required|integer|min:60000|max:5000000",
            "foto"               => "required|image|mimes:jpg,png,jpeg|max:10000",
        ];
    }
}
