<?php

namespace App\Http\Controllers\Patient;

use App\Http\Requests\Patient\StoreRequest;
use App\Models\Appointment;
use App\Models\Doctor;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class StoreAppointmentController extends BaseController
{
    public function __invoke(StoreRequest $request): RedirectResponse
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        if (!auth()->user()->hasRole('patient')) {
            return redirect()->route('dashboard');
        }

        $validated = $request->validated();

        $startTime = new \DateTime($validated['start_time']);
        $doctor = Doctor::findOrFail($validated['doctor_id']);
        $endTime = (clone $startTime)->modify("+{$doctor->appointment_duration} minutes");

        // Checking doctor availability
        $isBooked = Appointment::where('doctor_id', $doctor->id)
            ->where(function ($query) use ($startTime, $endTime) {
                $query->whereBetween('start_time', [$startTime, $endTime])
                      ->orWhereBetween('end_time', [$startTime, $endTime])
                      ->orWhere(function ($query) use ($startTime, $endTime) {
                          $query->where('start_time', '<=', $startTime)
                                ->where('end_time', '>=', $endTime);
                      });
            })
            ->exists();

        if ($isBooked) {
            return redirect()
                ->back()
                ->withErrors(['start_time' => 'The doctor is busy at this time.'])
                ->withInput();
        }

        // Checking doctor's working hours
        $openingHours = $doctor->openingHours->first();
        $hours = $openingHours ? $openingHours->hours : [];
        $dayOfWeek = mb_strtolower($startTime->format('l'));

        if (!isset($hours[$dayOfWeek])) {
            return redirect()
                ->back()
                ->withErrors(['start_time' => 'The doctor does not work on this day.'])
                ->withInput();
        }

        // Check time within working hours
        $workingHours = $hours[$dayOfWeek];
        $time = $startTime->format('H:i');
        $isWithinHours = false;

        foreach ($workingHours as $range) {
            if ($range === null) {
                continue;
            }

            [$open, $close] = explode('-', $range);
            if ($time >= $open && $time < $close) {
                $isWithinHours = true;
                break;
            }
        }

        if (!$isWithinHours) {
            return redirect()
                ->back()
                ->withErrors(['start_time' => 'The doctor is not available at this time.'])
                ->withInput();
        }

        $patient = Auth::user()->patient;
        Appointment::create([
            'start_time' => $startTime->format('Y-m-d H:i:s'),
            'end_time' => $endTime->format('Y-m-d H:i:s'),
            'patient_id' => $patient->id,
            'doctor_id' => $doctor->id,
        ]);

        return redirect()->route('patient.index')->with('success', 'Appointment created successfully!');
    }
}