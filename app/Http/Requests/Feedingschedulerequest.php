<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Feedingschedulerequest extends FormRequest
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
            "scheduleid"=>"required|alpha_dash",
            "animal_animalid"=>"required|alpha_dash",
            "feed_feedid"=>"required|alpha_dash",
            "date_of_feeding"=>"required|date",
            "quantity"=>"required|alpha_num"
        ];
    }
}
