<?php

namespace App\Http\Controllers\Booking;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use App\Models\TimeSlot;
use Illuminate\View\View;

class CreateController extends Controller
{
    public function __invoke($doctorId): View
    {
        $doctor = Doctor::with('user')->findOrFail($doctorId);
        $timeSlots = TimeSlot::where('doctor_id', $doctorId)->where('is_available', true)->get();

        return view('booking.create', ['doctor' => $doctor, 'timeSlots' => $timeSlots]);
    }
}
