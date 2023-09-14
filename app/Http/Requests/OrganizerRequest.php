<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrganizerRequest extends FormRequest
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
            'inputOrganizer' => ['required', 'max:255'],
            'inputLocation' => ['required', 'max:255']
        ];
    }

    public function attributes(): array
    {
        return [
            'inputOrganizer' => 'Organizer',
            'inputLocation' => 'Location'
        ];
    }

    public function messages(): array
    {
        return [
            'inputOrganizer' => 'Enter Organizer name',
            'inputLocation' => 'Enter Image location'
        ];
    }
}
