<?php

namespace App\Http\Requests\Admin\Staff;

use Illuminate\Foundation\Http\FormRequest;

class StaffCreateRequest extends FormRequest
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
            'name' => 'required|string|max:50',
            'email' => 'required|max:50',
            'phone' => 'required|max:11|min:11',
            'password' => 'required|min:8',
            'emp_type' => 'required',
            'profile_photo_path ' => 'nullable|mimes:jpeg,jpg,png',
            'designation' => 'required',
            'employment_type' => 'required'
        ];
    }
}
