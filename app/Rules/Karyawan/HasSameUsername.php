<?php

namespace App\Rules\Karyawan;

use App\Models\Karyawan;
use Illuminate\Contracts\Validation\Rule;

class HasSameUsername implements Rule
{
    private $username;

    /**
     * Create a new rule instance.
     *
     * @param $username
     */
    public function __construct($username)
    {
        $this->username = $username;
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
        $member = Karyawan::query()->where('username', $this->username)->first();

        // if username is not exists
        if (!$member) {
            return true;
        }

        // if username of logged in member is same as what we get from database
        if (auth('karyawan')->user()->username === $member->username) {
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
        return 'Username sudah digunakan';
    }
}
