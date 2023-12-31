<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ResultRequest extends FormRequest
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
            'has_covid' => ['required', 'boolean'],
            'has_flu_a' => ['boolean'],
            'has_flu_b' => ['boolean'],
            'has_rsv' => ['boolean'],
            'physician' => ['required', Rule::in([
                'Nabil Suliman, MD',
                'Bethany Brooks, PA-C',
                'Alexis Arment, FNP',
                'S. Chowdhury, MD',
                'Shahid Ansari, MD',
                'Njita Honorine, FNP',                
            ])]
            // 'document' => ['required', 'file', 'max:1024', 'mimetypes:application/pdf']
        ];
    }
}
