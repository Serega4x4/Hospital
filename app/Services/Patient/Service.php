<?php

namespace App\Services\Patient;

use App\Models\Appointment;
use App\Models\Doctor;

class Service
{
    public function store()
    {
        //
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
