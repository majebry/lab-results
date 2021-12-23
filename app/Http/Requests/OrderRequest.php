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
            'patient_id' => ['required'],
            'patient_first_name' => ['required', 'string'],
            'patient_last_name' => ['required', 'string'],
            'patient_date_of_birth' => ['required', 'date_format:Y-m-d'],
            'patient_phone' => ['required'], // TODO regex format
            'patient_email' => ['email', 'nullable'],
            'reason_of_test' => ['required'], // TODO in
            'covid_test_type' => ['required'], // TODO in
            'date_of_test' => ['required', 'date_format:Y-m-d'],
        ];
    }
}
