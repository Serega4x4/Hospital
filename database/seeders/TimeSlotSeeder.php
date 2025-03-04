<?php

namespace Database\Seeders;

use App\Models\Doctor;
use App\Models\TimeSlot;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TimeSlotSeeder extends Seeder
{
    public function run(): void
    {
        TimeSlot::truncate();

        $doctors = Doctor::all();

        $daysToGenerate = 7;

        foreach ($doctors as $doctor) {
            for ($day = 0; $day < $daysToGenerate; $day++) {
                $currentDate = Carbon::now()->startOfDay()->addDays($day);

                if ($currentDate->isWeekend()) {
                    continue;
                }

                $startDate = $currentDate->copy()->addHours(9);

                $endDate = $currentDate->copy()->addHours(17);

                while ($startDate->lt($endDate)) {
                    TimeSlot::create([
                        'doctor_id' => $doctor->id,
                        'start_time' => $startDate->format('Y-m-d H:i:s'),
                        'end_time' => $startDate->copy()->addMinutes(20)->format('Y-m-d H:i:s'),
                        'is_available' => true,
                    ]);

                    $startDate->addMinutes(20);
                }
            }
        }
    }
}