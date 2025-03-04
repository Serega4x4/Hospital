<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TimeSlot extends Model
{
    protected $fillable = ['start_time', 'end_time', 'is_available', 'doctor_id'];

    protected $casts = [
        'start_time' => 'datetime',
        'end_time' => 'datetime',
    ];

    public function doctor(){
        return $this->belongsTo(Doctor::class);
    }
}


