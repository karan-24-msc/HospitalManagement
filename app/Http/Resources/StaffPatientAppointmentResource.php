<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StaffPatientAppointmentResource extends JsonResource
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
            'app_id' => $this->app_id,
            'app_name' => $this->app_name,
            'app_email ' => $this->app_email ,
            'app_phone' => $this->app_phone,
            'app_age' => $this->app_age,
            'app_gender' => $this->app_gender,
            'department' =>  new DepartmentResource($this->whenLoaded('departmentInfo')),
            'doctor' => new StaffResource($this->whenLoaded('staff')),
            'app_date' => Carbon::parse( $this->app_date)->format('d/m/Y'),
            'notes' => $this->notes,
            'patient_status' => $this->patient_status,
            'app_status' => $this->app_status,
        ];
    }
}
