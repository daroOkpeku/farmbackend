<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FinanceRecordrequest extends FormRequest
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
         'tagnumber'=>'required|string',
         'production_type'=>'required|string',
         'date_fin'=>'required|string',
         'items'=>'required|string',
         'input_cost'=>'required|alpha_num',
         'yield'=>'required|string',
         'current_value'=>'required|alpha_num',
         'revenue'=>'required|alpha_num',
         'profit'=>'required|alpha_num'
        ];
    }
}
