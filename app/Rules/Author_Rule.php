<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class Author_Rule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
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
        $regular = '/^([A-ZА-ЯЁ][a-zа-яё]+)\s([A-ZА-ЯЁ][a-zа-яё]+)$/u';
        // /^\s*[A-ZА-Я][a-zа-я]+('[a-zа-я]+|-[A-ZА-Я][a-zа-я]+)?\s*$/u
         $param = preg_match($regular, $value);
         if($param) return true;
         return false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Author field required and must been two word, first letter in Uppercase';
    }
}
