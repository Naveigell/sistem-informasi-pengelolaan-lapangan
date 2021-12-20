<?php

namespace App\Rules;

use App\Models\Member;
use Illuminate\Contracts\Validation\Rule;

class OldPasswordValidated implements Rule
{
    private $password;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($password)
    {
        $this->password = $password;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $member = Member::query()->find(auth('member')->id());

        // if member not login
        if (!$member) {
            return false;
        }

        return \Hash::check($this->password, $member->password);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Password lama salah';
    }
}
