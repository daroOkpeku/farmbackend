<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Feedrequest extends FormRequest
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
            "feedid"=>"required|alpha_dash",
            "feedtype"=>"required|string",
            "feeddetails"=>"required|string",
        ];
    }
}
