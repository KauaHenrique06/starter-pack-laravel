<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\Http;
use Illuminate\Translation\PotentiallyTranslatedString;

class ValidZipCodeRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  Closure(string, ?string=): PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $zipCode = preg_replace('/[^0-9]/', '', $value);

        if(strlen($zipCode) !== 8) {
            $fail('The zip code must be have 8 numbers');
            return;
        }

        $response = Http::get("https://brasilapi.com.br/api/cep/v2/{$zipCode}");

        if(!$response) {
            $fail("The zip code wasn't found in the database ");
            return;
        }
    }
}
