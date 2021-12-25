<?php

namespace App\Http\Requests\Karyawan;

use App\Rules\Karyawan\HasSameEmail;
use App\Rules\Karyawan\HasSamePhoneNumber;
use App\Rules\Karyawan\HasSameUsername;
use Illuminate\Foundation\Http\FormRequest;

class BiodataRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "nama_pengguna"   => "required|min:5",
            "email"           => ['required', 'min:5', new HasSameEmail($this->get('email')), 'email'],
//            "username"        => ['required', 'min:5', new HasSameUsername($this->get('username'))],
            "alamat"          => "required|min:5",
            "no_telp"         => ['required', 'numeric', 'min:5', new HasSamePhoneNumber($this->get('no_telp'))],
        ];
    }
}
