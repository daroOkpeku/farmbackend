<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HealthRecordCreateRequest extends FormRequest
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
            'vacation_date'=>'required|string',
            'vaccine_name'=>'required|string',
            'treatments'=>'required|string',
            'treatments_date'=>'required|string',
            'illness'=>'required|string',
            'dose'=>'required|string',
            'cost'=>'required|alpha_num',
            'treated_by_vcn_number'=>'required|string',
            'status'=>'required|string',
            "tagnumber"=>"string",
        ];
    }
}
