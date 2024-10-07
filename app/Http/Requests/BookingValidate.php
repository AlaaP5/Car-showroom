<?php

namespace App\Http\Requests;

use App\Rules\SeatsAvailable;
use App\Rules\TripStartsSoon;
use Illuminate\Foundation\Http\FormRequest;

class BookingValidate extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'trip_id' => ['required', 'exists:trips,id', new TripStartsSoon($this->trip_id)],
            'seats_booked' => ['required', 'integer', 'min:1', new SeatsAvailable($this->trip_id)]
        ];
    }
}
