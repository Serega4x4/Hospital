<?php
namespace App\Http\Controllers\Admin\Doctor;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Doctor\StoreRequest;
use App\Models\Doctor;
use App\Models\OpeningHour;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;

class StoreController extends Controller
{
    public function __invoke(StoreRequest $request): RedirectResponse
    {
        $validatedData = $request->validated();
        // dd($validatedData);

        if (!Auth::check()) {
            return redirect()->route('login');
        }



        if (!auth()->user()->hasRole('superadmin|admin')) {
            return redirect()->route('dashboard');
        }

        $user = User::create([
            'first_name' => $validatedData['first_name'],
            'last_name' => $validatedData['last_name'],
            'pesel' => $validatedData['pesel'],
            'email' => $validatedData['email'],
            'password' => bcrypt($validatedData['password']),
        ]);

        $doctor = Doctor::create([
            'speciality' => $validatedData['speciality'],
            'appointment_duration' => $validatedData['appointment_duration'] ?? 15,
            'user_id' => $user->id,
        ]);

        $defaultHours = [
            'monday' => ['08:00-12:00', '13:00-17:00'],
            'tuesday' => ['08:00-12:00', '13:00-17:00'],
            'wednesday' => ['08:00-12:00', '13:00-17:00'],
            'thursday' => ['08:00-12:00', '13:00-17:00'],
            'friday' => ['08:00-12:00', '13:00-17:00'],
            'saturday' => [],
            'sunday' => [],
        ];

        OpeningHour::create([
            'doctor_id' => $doctor->id,
            'hours' => $validatedData['hours'] ?? $defaultHours,
        ]);

        $doctorRole = Role::firstOrCreate(['name' => 'doctor']);
        $user->assignRole($doctorRole);

        return redirect()->route('admin.doctor.index')->with('success', 'Doctor created successfully.');
    }
}