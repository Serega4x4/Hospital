<?php

namespace App\Services\Patient;

use App\Models\Appointment;
use App\Models\Doctor;
use Illuminate\Support\Facades\Auth;

class Service
{
    public function store($validated)
    {
        $startTime = new \DateTime($validated['start_time']);
        $doctor = Doctor::findOrFail($validated['doctor_id']);
        $endTime = (clone $startTime)->modify("+{$doctor->appointment_duration} minutes");

        // Checking doctor availability
        $isBooked = Appointment::where('doctor_id', $doctor->id)
            ->where(function ($query) use ($startTime, $endTime) {
                $query
                    ->whereBetween('start_time', [$startTime, $endTime])
                    ->orWhereBetween('end_time', [$startTime, $endTime])
                    ->orWhere(function ($query) use ($startTime, $endTime) {
                        $query->where('start_time', '<=', $startTime)->where('end_time', '>=', $endTime);
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
    }

    public function update()
    {
        //
    }

    public function getAvailableSlots(Doctor $doctor)
    {
        $slots = [];
        $today = new \DateTime();
        $endDate = (clone $today)->modify('+7 days'); // Showing a week ahead

        $openingHours = $doctor->openingHours->first();
        $hours = $openingHours ? $openingHours->hours : [];

        // We get all existing records
        $bookedAppointments = Appointment::where('doctor_id', $doctor->id)->where('start_time', '>=', $today)->where('start_time', '<=', $endDate)->get();

        while ($today <= $endDate) {
            $dayOfWeek = mb_strtolower($today->format('l'));

            if (isset($hours[$dayOfWeek])) {
                $workingHours = $hours[$dayOfWeek];

                foreach ($workingHours as $range) {
                    if ($range === null) {
                        continue;
                    }

                    [$start, $end] = explode('-', $range);
                    $currentTime = \DateTime::createFromFormat('H:i', $start, new \DateTimeZone('UTC'));
                    $endTime = \DateTime::createFromFormat('H:i', $end, new \DateTimeZone('UTC'));

                    while ($currentTime < $endTime) {
                        $slotStart = (clone $today)->setTime((int) $currentTime->format('H'), (int) $currentTime->format('i'));
                        $slotEnd = (clone $slotStart)->modify("+{$doctor->appointment_duration} minutes");

                        // Checking if the time is busy
                        $isBooked = $bookedAppointments->contains(function ($appointment) use ($slotStart, $slotEnd) {
                            $appStart = new \DateTime($appointment->start_time);
                            $appEnd = new \DateTime($appointment->end_time);
                            return $slotStart < $appEnd && $slotEnd > $appStart;
                        });

                        if (!$isBooked && $slotStart > new \DateTime()) {
                            $slots[] = [
                                'date' => $slotStart->format('Y-m-d'),
                                'time' => $slotStart->format('H:i'),
                                'datetime' => $slotStart->format('Y-m-d H:i:s'),
                            ];
                        }

                        $currentTime->modify("+{$doctor->appointment_duration} minutes");
                    }
                }
            }

            $today->modify('+1 day');
        }

        return response()->json($slots);
    }
}
