<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\OpeningHours\OpeningHours;

class OpeningHour extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['doctor_id', 'hours'];

    protected $casts = [
        'hours' => 'array',
    ];

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }

    public function getOpeningHoursAttribute()
    {
        return OpeningHours::create($this->hours);
    }
}
