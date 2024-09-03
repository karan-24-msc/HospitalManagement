<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PatientPrescriptionListResource extends JsonResource
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
            'patient_id' => $this->patient_id,
            'doctor_id' => $this->doctor_id,
            'disease_description' => $this->disease_description,
            'clinical_diagnosis' => $this->clinical_diagnosis,
            'advice' => $this->advice,
            'medicine_treatment' => json_decode($this->medicine_treatment),
            'patientInfo' => new PatientResource($this->whenLoaded('patientInfo')),
            'date' => Carbon::parse($this->date)->format('Y-m-d'),
        ];
    }
}
