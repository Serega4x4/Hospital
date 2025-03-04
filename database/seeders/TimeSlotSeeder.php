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
        $doctors = Doctor::all();
        TimeSlot::truncate();


        foreach ($doctors as $doctor) {
            $startDate = Carbon::now()->startOfDay()->addHours(9);
            $endDate = Carbon::now()->startOfDay()->addHours(17);

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
