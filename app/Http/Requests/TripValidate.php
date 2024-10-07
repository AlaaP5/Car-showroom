<?php

namespace App\Http\Requests;

use App\Rules\FutureDate;
use Illuminate\Foundation\Http\FormRequest;

class TripValidate extends FormRequest
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
            'destination_id' => 'required|exists:destinations,id',
            'price' => 'required|numeric|between:0,999999.99',
            'available_seats' => 'required|integer|min:1',
            'start_date' => ['required', 'date', new FutureDate()],
            'end_date' => 'required|date|after:start_date',
        ];
    }
}
