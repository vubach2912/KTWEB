<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class BnetUserExisted implements Rule
{

    public function __construct()
    {
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param string $attribute
     * @param mixed $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $bnetModel = \App\Models\BNET::where('acct_username', $value)->first();
        if ($bnetModel) {
            return false;
        }
        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Tài khoản này đã tồn tại.';
    }
}
