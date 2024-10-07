<?php

namespace App\Rules;

use App\Helpers\DateNow;
use App\Models\Trip;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class TripStartsSoon implements ValidationRule
{
    protected $tripId;

    public function __construct($tripId)
    {
        $this->tripId = $tripId;
    }
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $trip = Trip::find($this->tripId);

        if (empty($trip)) {
            $fail('The selected trip does not exist.');
            return;
        }

        if (DateNow::presentTime(now()) >= $trip->start_date) {
            $fail('You cannot book this trip as it has already started.');
        }
    }
}
