<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PatientAppointment extends Model
{
    use HasFactory;

    protected $guarded;

    public function staff(): BelongsTo
    {
        return $this->belongsTo(User::class,'doctor');
    }

    public function departmentInfo(): BelongsTo
    {
        return $this->belongsTo(Department::class,'department');
    }

    protected static function boot()
    {
        parent::boot();
        self::creating(function($model) {
            $model->created_at = Carbon::now();
        });

        self::updating(function($model) {
            $model->updated_at = Carbon::now();
        });

    }
}
