<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'email' => ['required', 'email', 'max:100'],
            'password' => ['required', 'max:100']
        ];
    }

    public function attributes(): array
    {
        return [
            'email' => 'Email',
            'password' => 'Password'
        ];
    }

    public function messages(): array
    {
        return [
            'email' => 'Enter email',
            'password' => 'Enter password'
        ];
    }
}
