<?php

namespace App\Http\Requests\Member;

use App\Rules\HasSameEmail;
use App\Rules\HasSamePhoneNumber;
use Illuminate\Contracts\Validation\Validator;
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
            "nama_member"   => "required|min:5",
            "email"         => ['required', 'min:5', new HasSameEmail($this->get('email')), 'email'],
            "alamat_member" => "required|min:5",
            "hp"            => ['required', 'numeric', 'min:5', new HasSamePhoneNumber($this->get('hp'))],
        ];
    }
}
