<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Arduinorequest extends FormRequest
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
            'voltage' => 'required|numeric',
            'current' => 'required|numeric',
            'frequency' => 'required|integer',
            'power' => 'required|integer',
            'energy' => 'required|integer',
            'runtime' => 'required|integer',
            'temperature' => 'required|integer',
            'oil_level' => 'required|integer',
            'oil_quality' => 'required|integer',
            'fuel_level' => 'required|integer',
            'rpm' => 'required|integer',
            'gyration' => 'required|integer',
            'health_status' => 'required|string'
        ];
    }
}
