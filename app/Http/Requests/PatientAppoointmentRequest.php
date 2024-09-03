<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PatientAppoointmentRequest extends FormRequest
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
        return [
            'name' => 'required|min:4|max:30',
            'email' => 'required|email',
            'phone' => 'required',
            'app_age' => 'required|integer|min:1',
            'app_gender' => 'required',
            'department' => 'required',
            'doctor' => 'required',
            'date' => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Name is required.',
            'name.min' => 'Name must be at least 4 characters long.',
            'name.max' => 'Name cannot be longer than 30 characters.',
            'email.required' => 'Email is required.',
            'email.email' => 'Please provide a valid email address.',
            'phone.required' => 'Phone number is required.',
            'app_age.required' => 'Age is required.',
            'app_age.integer' => 'Age must be a valid number.',
            'app_age.min' => 'Age must be at least 1.',
            'app_gender.required' => 'Gender is required.',
            'department.required' => 'Department selection is required.',
            'doctor.required' => 'Doctor selection is required.',
            'app_date.required' => 'The appointment date is required.',
        ];
    }
}
