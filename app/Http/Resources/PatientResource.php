<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PatientResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'appointment' => new StaffPatientAppointmentResource($this->whenLoaded('appointmentInfo')),
            'department' =>new DepartmentResource($this->whenLoaded('departmentInfo')),
            'doctor' => new StaffResource($this->whenLoaded('doctor')),
            'registration_no' => $this->registration_no,
            'name' => $this->name,
            'age' => $this->age,
            'gender' => $this->gender,
            'blood_group' => $this->blood_group,
            'contact' => $this->contact,
            'opt_contact' => $this->opt_contact,
            'email' => $this->email,
            'religion' => $this->religion,
            'father_name' => $this->father_name,
            'father_bg' => $this->father_bg,
            'father_age' => $this->father_age,
            'mother_name' => $this->mother_name,
            'mother_bg' => $this->mother_bg,
            'mother_age' => $this->mother_age,
            'address' => $this->address,
            'status' => $this->status,
        ];
    }
}
