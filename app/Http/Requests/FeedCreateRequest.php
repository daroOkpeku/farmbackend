<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FeedCreateRequest extends FormRequest
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
        // 'producationtype',
        // 'ration',
        // 'ration_composition',
        // 'disorders',
        return [
           'feedid'=>'alpha_num',
           'tagnumber'=>'required|string',
           'feedtype'=>'required|string',
            'schedule'=>'required|string',
            'qty'=>'required|alpha_num',
            'cost'=>'required|alpha_num',
            'feeddetail'=>'required|string|nullable',
            'producationtype'=>'required|string',
            'ration'=>'required|alpha_num',
            'ration_composition'=>'required|string',
            'disorders'=>'required|string',
            'id'=>'alpha_num'
        ];
    }
}
