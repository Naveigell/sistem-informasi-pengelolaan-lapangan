<?php

namespace App\Http\Requests\Auth\Member;

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
            "email"     => "required|string|min:5",
            "password"  => "required|string|min:5"
        ];
    }
}
