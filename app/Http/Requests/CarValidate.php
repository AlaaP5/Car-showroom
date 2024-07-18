<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CarValidate extends FormRequest
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
            'nameType' => 'required|string',
            'image' => 'required|image|mimes:png,jpg',
            'model' => 'required|numeric',
            'color' => 'required|string',
            'status' => 'required|string',
            'gear' => 'required|string',
            'quantity' => 'required|integer',
            'priceC' => 'required|integer',
            'priceI' => 'required|integer',
            'category_id' => 'required|exists:categories,id',
            'company_id' => 'required|exists:companies,id'
        ];
    }
}
