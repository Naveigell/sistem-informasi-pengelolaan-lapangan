<?php

namespace App\Http\Requests\Auth\Karyawan;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "username"  => "required|string|min:5",
            "password"  => "required|string|min:5",
        ];
    }
}
