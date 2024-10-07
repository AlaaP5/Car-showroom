<?php

namespace App\Rules;

use App\Helpers\DateNow;
use Carbon\Carbon;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class FutureDate implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (DateNow::presentTime(now()->addHour()) > DateNow::presentTime($value)) {
            $fail('The start date must be one hour greater than the current time.');
        }
    }
}
