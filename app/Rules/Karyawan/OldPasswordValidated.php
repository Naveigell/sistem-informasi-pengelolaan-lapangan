<?php

namespace App\Rules\Karyawan;

use App\Models\Karyawan;
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
        $karyawan = Karyawan::query()->find(auth('karyawan')->id());

        // if karyawan not login
        if (!$karyawan) {
            return false;
        }

        return \Hash::check($this->password, $karyawan->password);
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
