<?php

namespace App\Rules\Karyawan;

use App\Models\Karyawan;
use App\Models\Member;
use Illuminate\Contracts\Validation\Rule;

class HasSameEmail implements Rule
{
    private $email;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($email)
    {
        $this->email = $email;
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
        $member = Karyawan::query()->where('email', $this->email)->first();

        // if email is not exists
        if (!$member) {
            return true;
        }

        // if email of logged in member is same as what we get from database
        if (auth('karyawan')->user()->email === $member->email) {
            return true;
        }

        return false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Email sudah digunakan';
    }
}
