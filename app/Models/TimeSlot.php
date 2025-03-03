<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TimeSlot extends Model
{
    protected $fillable = ['start_time', 'end_time', 'is_available', 'doctor_id'];

    public function doctor(){
        return $this->belongsTo(User::class);
    }
}


