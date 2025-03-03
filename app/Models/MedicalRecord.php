<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MedicalRecord extends Model
{
    protected $fillable = ['first_visit_date', 'last_visit_date', 'symptoms', 'diagnosis', 'tests', 'treatment', 'patient_id', 'doctor_id'];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }
}
