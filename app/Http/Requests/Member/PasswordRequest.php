<?php

namespace App\Http\Requests\Member;

use App\Rules\OldPasswordValidated;
use Illuminate\Foundation\Http\FormRequest;

class PasswordRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "old_password"              => ['required', 'min:6', new OldPasswordValidated($this->get('old_password'))],
            "new_password"              => "required|min:6|same:new_password_confirmation",
            "new_password_confirmation" => "required|min:6|same:new_password",
        ];
    }
}
