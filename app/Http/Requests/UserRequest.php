<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
        $rules = [
            'name' => ['required', 'string'],
            'email' => ['required', Rule::unique('users')->ignore($this->route('user'))],
            'password' => ['nullable', 'min:6'],
            'role' => ['required', 'exists:roles,id']
        ];

        if (! $this->isMethod('patch')) {
            $rules['password'] = ['required', 'min:6'];
        }
        
        return $rules;
    }
}
