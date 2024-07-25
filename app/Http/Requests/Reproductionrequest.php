<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Reproductionrequest extends FormRequest
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
            "reproductionid"=>"required|alpha_num",
            "animal_animalid"=>"required|alpha_dash",
            "breedingdate"=>"required|date",
            "pregnancycheckdate"=>"required|date",
            "outcome"=>"required|string",
            "birtheventdate"=>"required|date"
        ];
    }
}
