<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Admission extends Model
{
    use HasFactory;

    protected $guarded;

    public function patient(): BelongsTo
    {
        return $this->belongsTo(Patient::class,'patient_id');
    }

    public function unit(): BelongsTo
    {
        return $this->belongsTo(Unit::class,'unit_id');
    }

    public function bed(): BelongsTo
    {
        return $this->belongsTo(Bed::class,'bed_id');
    }

    public function doctor(): BelongsTo
    {
        return $this->belongsTo(User::class,'consultant_id');
    }
}
