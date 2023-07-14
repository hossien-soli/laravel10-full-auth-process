<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\Lang;

class AlphaSymbolsNumbers implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $validCharsStr = 'AaBbCcDdEeFfGgHhIiJjKkLlMmNnOoPpQqRrSsTtUuVvWwXxYyZz0123456789!@#$%^&*';
        $validCharsArr = str_split($validCharsStr);
        $value = (string) $value;
        $valueChars = str_split($value);
        $isValid = true;
        foreach ($valueChars as $char) {
            if (!in_array($char,$validCharsArr)) {
                $isValid = false;
                break;
            }
        }
        if (!$isValid) {
            $fail(Lang::get('custom.alpha_symbols_numbers'));
        }
    }
}
