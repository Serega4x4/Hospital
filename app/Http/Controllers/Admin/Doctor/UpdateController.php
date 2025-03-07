<?php
namespace App\Http\Controllers\Admin\Doctor;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Doctor\UpdateRequest;
use App\Models\Doctor;
use App\Models\OpeningHour;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class UpdateController extends Controller
{
    public function __invoke(UpdateRequest $request, $id): RedirectResponse
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        if (!auth()->user()->hasRole('superadmin|admin')) {
            return redirect()->route('dashboard');
        }

        $user = User::find($id);
        if (!$user) {
            return redirect()->route('admin.doctor.index')->with('error', 'User not found.');
        }

        $validatedData = $request->validated();
        if (isset($validatedData['password'])) {
            $validatedData['password'] = bcrypt($validatedData['password']);
        }

        $userData = array_filter([
            'first_name' => $validatedData['first_name'],
            'last_name' => $validatedData['last_name'],
            'pesel' => $validatedData['pesel'],
            'email' => $validatedData['email'],
            'password' => isset($validatedData['password']) ? bcrypt($validatedData['password']) : null,
        ], fn($value) => !is_null($value));

        $user->update($userData);

        $doctor = Doctor::where('user_id', $user->id)->first();
        $doctor->update([
            'speciality' => $validatedData['speciality'],
            'appointment_duration' => $validatedData['appointment_duration'] ?? $doctor->appointment_duration,
        ]);

        $openingHour = OpeningHour::where('doctor_id', $doctor->id)->first();
        if ($request->hours) {
            $openingHour->update(['hours' => $request->hours]);
        }

        return redirect()->route('admin.doctor.index')->with('success', 'Doctor created successfully.');
    }
}
