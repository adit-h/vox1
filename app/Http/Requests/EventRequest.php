<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EventRequest extends FormRequest
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
            'inputDate' => ['required', 'date'],
            'inputType' => ['required'],
            'inputName' => ['required'],
            'inputOrgId' => ['required'],
        ];
    }

    public function attributes(): array
    {
        return [
            'inputDate' => 'Date',
            'inputType' => 'Type',
            'inputName' => 'Name',
            'inputOrgId' => 'Organizer Id',
        ];
    }

    public function messages(): array
    {
        return [
            'inputDate' => 'Enter Event date',
            'inputType' => 'Enter Event type',
            'inputName' => 'Enter Event Name',
            'inputOrgId' => 'Select Organizer Id',
        ];
    }
}
