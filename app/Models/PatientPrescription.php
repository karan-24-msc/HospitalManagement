<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PatientPrescription extends Model
{
    use HasFactory;

    protected $fillable = [
        'medicine_treatment',
        'disease_description',
        'clinical_diagnosis',
        'advice',
        'patient_id',
        'doctor_id',
        'date',
    ];

    protected $casts = [
        'medicine_treatment' => 'array',
        'date' => 'datetime',
    ];

    public function patientInfo(): BelongsTo
    {
        return $this->belongsTo(Patient::class,'patient_id');
    }
}
