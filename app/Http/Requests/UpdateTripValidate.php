<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTripValidate extends FormRequest
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
            'trip_id' => 'required|exists:trips,id',
            'destination_id' => 'exists:destinations,id',
            'price' => 'numeric|between:0,999999.99',
            'available_seats' => 'integer|min:0',
            'start_date' => 'date',
            'end_date' => 'date|after:start_date',
        ];
    }
}
