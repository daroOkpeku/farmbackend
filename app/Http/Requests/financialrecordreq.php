<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class financialrecordreq extends FormRequest
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
            "recordid"=>"required|alpha_dash",
            "farm_farmid"=>"required|alpha_dash",
            "type_of_finance"=>"required|string",
            "amount"=>"required|alpha_num",
            "date_of_finance"=>"required|date",
            "details"=>"required|string"
        ];
    }
}
