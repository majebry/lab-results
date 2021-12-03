<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TestReportRequest extends FormRequest
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
            'report_number' => ['required', 'integer','unique:test_reports'],
            'patient_id' => ['required'],
            'first_name' => ['required', 'string'],
            'last_name' => ['required', 'string'],
            'birthdate' => ['required', 'date_format:Y-m-d'],
            'covid_result' => ['required'],
            'file' => ['required', 'file', 'max:10240', 'mimetypes:application/pdf']
        ];
    }
}
