<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Patient extends Model
{
    use HasFactory;

    protected $guarded;

    public function appointmentInfo(): BelongsTo
    {
        return $this->belongsTo(PatientAppointment::class,'appointment_id');
    }

    public function doctor(): BelongsTo
    {
        return $this->belongsTo(User::class,'assigned_doc');
    }

    public function departmentInfo(): BelongsTo
    {
        return $this->belongsTo(Department::class,'assigned_dep');
    }

    public function admission(): HasMany
    {
        return $this->hasMany(Admission::class,'patient_id','id');
    }
}
