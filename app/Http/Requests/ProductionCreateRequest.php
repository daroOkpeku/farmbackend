<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductionCreateRequest extends FormRequest
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
                 'production_type'=>'required|string',
                 'weight'=>'required|alpha_num',
                   'date'=>'required|string',
                   'production_cycle'=>'required|string',
                   'yield'=>'required|string',
                    'cost'=>'required|alpha_num',
                    'disorders'=>'required|string',
                     'estrus_cycle_start_date'=>'required|string',
                      'estrus_cycle_end_date'=>'required|string',
                      'tagnumber'=>'required|string'
        ];
    }
}
