<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'patient_name' => ['required', 'string'],
            'patient_id_card_number' => ['required'],
            'patient_date_of_birth' => ['required', 'date_format:m/d/Y'],
            'patient_email' => ['email', 'nullable'],
            'reason_of_test' => ['required', 'in:Traveling,Exposed'],
            'covid_test_type' => ['required', 'in:Sars-cov-2 NAA,Sars-cov-2 PCR'],
            'date_of_test' => ['required', 'date_format:m/d/Y'],
        ];
    }
}
