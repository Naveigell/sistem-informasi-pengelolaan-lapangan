<?php

namespace App\Http\Requests\Auth\Member;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "name"             => "required|min:5",
            "email"            => "required|min:5|unique:members|email",
            "address"          => "required|min:5",
            "phone"            => "required|numeric",
            "password"         => "required|min:6|same:confirm_password",
            "confirm_password" => "required|min:6|same:password",
        ];
    }
}
