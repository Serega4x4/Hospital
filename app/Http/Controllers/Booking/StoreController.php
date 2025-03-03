<?php

namespace App\Http\Controllers\Booking;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\TimeSlot;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StoreController extends Controller
{
    public function __invoke(Request $request, $doctorId)
    {
        $request->validate([
            'time_slot_id' => 'required|exists:time_slots,id',
            'symptoms' => 'nullable|string',
            'notes' => 'nullable|string',
        ]);

        $patient = Auth::user()->patient;

        $appointment = Appointment::create([
            'patient_id' => $patient->id,
            'doctor_id' => $doctorId,
            'appointment_date' => TimeSlot::find($request->time_slot_id)->start_time,
            'symptoms' => $request->symptoms,
            'notes' => $request->notes,
            'status' => 'scheduled',
        ]);

        $timeSlot = TimeSlot::find($request->time_slot_id);
        $timeSlot->is_available = false;
        $timeSlot->save();

        return redirect()->route('booking.index')
            ->with('success', 'Запись на прием успешно создана.');
    }
}
