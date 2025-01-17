<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Bed extends Model
{
    use HasFactory;

    protected $fillable = [
        'unit_id',
        'name',
        'bed_type',
    ];

    public function unit(): BelongsTo
    {
        return $this->belongsTo(Unit::class,'unit_id');
    }
}
