<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class Unicode implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if ($this->check_unicode_character($value) ) {
            $fail('The :attribute contains invalid character');
        }
    }

    function check_unicode_character($character, $exclude = null)
    {
        return (mb_detect_encoding($character, "auto") == "UTF-8") ? true : false;

    }
}
