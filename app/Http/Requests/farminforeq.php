<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class farminforeq extends FormRequest
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
            "animalid"=>'required|alpha_dash',
            "farmname"=>'required|string',
            "farmid"=>"required|alpha_dash",
            "location"=>"required|string",
            "owner"=>"required|string",
            "size"=>"required|alpha_num",
            "farmtype"=>"required|string",

            "farm_farmid"=>"required|alpha_dash",
            "phone"=>"required|alpha_dash",
            "email"=>"required|email|unique:farmdetails,email",
            "website"=>"required|url",
        ];
    }
}
