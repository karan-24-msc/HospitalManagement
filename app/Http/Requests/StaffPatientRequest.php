<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StaffPatientRequest extends FormRequest
{
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = [
            'name' => 'required',
            'age' => 'required|numeric',
            'gender' => 'required',
            'blood_group' => 'required',
            'contact' => 'required',
            'address' => 'required',
        ];

        if (!$this->has('patientId')) {
            $rules['assigned_dep'] = 'required';
            $rules['assigned_doc'] = 'required';
        }

        return $rules;
    }

    public function messages(): array
    {
        return [
            'name.required' => 'The name field is required.',
            'age.required' => 'The age field is required.',
            'age.numeric' => 'The age must be a number.',
            'gender.required' => 'Please select a gender.',
            'blood_group.required' => 'Please provide the blood group.',
            'contact.required' => 'The contact field is required.',
            'address.required' => 'The address field is required.',
            'assigned_dep.required' => 'Select Department',
            'assigned_doc.required' => 'Select Doctor',
        ];
    }
}
