<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => ['required', 'confirmed', 'min:6'],
            'company' => ['required_if:type,manager', 'string', 'max:255'],
            'parent_email' => ['required_if:type,employee', 'string', 'max:255', 'email', 'exists:users,email']
        ];
    }

    public function messages()
    {
        return [
            'parent_email.required_if' => 'The manager email field is required',
            'company.required_if' => 'The company field is required'
        ];
    }
}
