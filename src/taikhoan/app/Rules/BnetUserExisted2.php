<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class BnetUserExisted2 implements Rule
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
        $bnetModel = \App\Models\JXAccount::where('loginName', $value)->first();
        if ($bnetModel) {
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
        return 'Vui lòng nhập tên tài khoản chính xác.';
    }
}
