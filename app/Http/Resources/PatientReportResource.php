<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PatientReportResource extends JsonResource
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
            'patientInfo' => new PatientResource($this->whenLoaded('patientInfo')),
            'hematology' => json_decode($this->hematology),
            'biochemistry' => json_decode($this->biochemistry),
            'stool' => json_decode($this->stool),
            'urine' => json_decode($this->urine),
            'serology' => json_decode($this->serology),
            'immunology' => json_decode($this->immunology),
            'blood_bank' => json_decode($this->blood_bank),
            'histopathology_cytology' => json_decode($this->histopathology_cytology),
            'semen_analysis_fluid' => json_decode($this->semen_analysis_fluid),
            'microbiology' => json_decode($this->microbiology),
            'ultra_snow_gram' => json_decode($this->ultra_snow_gram),
            'x_ray' => json_decode($this->x_ray),
            'ecg' => json_decode($this->ecg),
            'eco_ett' => json_decode($this->eco_ett),
            'c_t_scan' => json_decode($this->c_t_scan),
            'others' => json_decode($this->others),
            'status' => $this->x_ray,
            'date' => Carbon::parse($this->created_at)->format('Y-m-d'),
        ];
    }
}
