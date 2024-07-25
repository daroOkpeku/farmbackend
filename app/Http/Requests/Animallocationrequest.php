<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Animallocationrequest extends FormRequest
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
            "locationid"=>"required|alpha_dash",
            "farm_farmid"=>"required|alpha_dash",
            "animal_animalid"=>"required|alpha_dash",
            "locationdetails"=>"required|string",
            "datemovedin"=>"required|date",
            "datemovedout"=>"required|date"
        ];
    }
}
