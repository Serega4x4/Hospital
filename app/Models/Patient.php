<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Permission\Traits\HasRoles;

class Patient extends Model
{
    use HasFactory, SoftDeletes, HasRoles;

    protected $fillable = ['address', 'medical_history', 'birthday', 'user_id'];

    public function prescriptions()
    {
        return $this->hasMany(Prescription::class);
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
