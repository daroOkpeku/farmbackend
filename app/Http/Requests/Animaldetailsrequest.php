<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Animaldetailsrequest extends FormRequest
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
            "animal_name"=>"required|string",
            "breed"=>"required|string",
            "age"=>"required|string",
            'weight'=>"required|string",
            "tagnumber"=>"required|string",
            "sex"=>"required|string",
            "health_status"=>"required|string",
            "farmname"=>"required|string"
        ];
    }
}
