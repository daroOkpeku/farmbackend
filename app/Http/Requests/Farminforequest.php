<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Farminforequest extends FormRequest
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
            "animalid"=>'required|regex:/^[a-zA-Z0-9- ]*$/',
            "farmname"=>'required|string',
            "farmid"=>"required|regex:/^[a-zA-Z0-9- ]*$/",
            "location"=>"required|string",
            "owner"=>"required|string",
            "size"=>"required|regex:/^[a-zA-Z0-9- ]*$/",
            "farmtype"=>"required|string",

            // "farm_farmid"=>"nullable|regex:/^[a-zA-Z0-9- ]*$/",
            "phone"=>"nullable|regex:/^[a-zA-Z0-9 ]*$/",
            "email"=>'nullable|email|unique:farmdetails,email',
            // "email"=>"email",
            "website"=>"nullable|string",
        ];
    }


}
