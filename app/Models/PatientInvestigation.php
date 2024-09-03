<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PatientInvestigation extends Model
{
    use HasFactory;

    protected $guarded;

    public function patientInfo(): BelongsTo
    {
        return $this->belongsTo(Patient::class,'patient_id');
    }
}
