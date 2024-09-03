<?php

namespace App\Http\Resources;

use App\Models\Unit;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AdmittedPatientResource extends JsonResource
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
            'admission_id' => $this->admission_id,
            'admission_status' => $this->admission_status,
            'admission_date' => Carbon::parse($this->admission_date)->format('d, M Y'),
            'unit' => new UnitResource($this->whenLoaded('unit')),
            'bed' => new BedResource($this->whenLoaded('bed')),
            'patient' => new PatientResource($this->whenLoaded('patient')),
            'doctor' => new StaffResource($this->whenLoaded('doctor')),
            'status' => $this->status,
        ];
    }
}
