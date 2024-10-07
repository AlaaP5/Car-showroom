<?php

namespace App\Rules;

use App\Models\Trip;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class SeatsAvailable implements ValidationRule
{
    protected $tripId;

    // Constructor to accept trip ID
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

        if ($value > $trip->available_seats) {
            $fail('The number of seats booked exceeds the available seats.');
        }
    }
}
