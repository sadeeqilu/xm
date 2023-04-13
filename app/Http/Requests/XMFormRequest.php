<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class XMFormRequest extends FormRequest
{

    protected $redirect = '/';
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'company_symbol' => 'required|max:6|min:2|regex:/[A-Z]/',
            'start_date' => 'required|date|before_or_equal:now',
            'end_date' => 'required|date|after_or_equal:start_date',
            'email' => 'required'
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'company_symbol.regex' => 'The company symbol should be between 2 and 6 capital letters.'
        ];
    }
}
