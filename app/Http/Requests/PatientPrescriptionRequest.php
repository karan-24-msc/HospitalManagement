<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PatientPrescriptionRequest extends FormRequest
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
            'medicine_treatment' => 'required|array|min:1',
            'medicine_treatment.*.name' => 'required|string|max:255',
            'medicine_treatment.*.take' => 'required|integer|min:1',
            'medicine_treatment.*.time' => 'required|string|in:Before Eating,After Eating',
            'date' => 'required|date',
            'disease_description' => 'required|string|max:255',
            'clinical_diagnosis' => 'required|string|max:255',
            'advice' => 'required|string|max:255',
            'patient_id' => 'required|integer|exists:patients,id',
        ];
    }

    public function messages()
    {
        return [
            'medicine_treatment.required' => 'At least one medicine must be provided.',
            'medicine_treatment.*.name.required' => 'Medicine name is required.',
            'medicine_treatment.*.take.required' => 'Medicine take (dosage) is required.',
            'medicine_treatment.*.time.required' => 'Medicine time (before/after eating) is required.',
            'date.required' => 'Prescription date is required.',
            'disease_description.required' => 'Disease description is required.',
            'clinical_diagnosis.required' => 'Clinical diagnosis is required.',
            'advice.required' => 'Advice is required.',
            'patient_id.exists' => 'The selected patient does not exist.',
        ];
    }
}
