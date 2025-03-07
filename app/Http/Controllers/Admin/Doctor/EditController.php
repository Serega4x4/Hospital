<?php

namespace App\Http\Controllers\Admin\Doctor;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class EditController extends Controller
{
    public function __invoke($id): View|RedirectResponse
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        if (!auth()->user()->hasRole('superadmin|admin')) {
            return redirect()->route('dashboard');
        }

        $doctor = User::find($id);
        if (!$doctor) {
            return redirect()->route('admin.doctor.index');
        }

        $doctorSpec = Doctor::find($doctor->doctor->id);
        $openingHour = $doctorSpec->openingHours;
        $days = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'];

        return view('admin.doctor.edit', [
            'doctor' => $doctor,
            'doctorSpec' => $doctorSpec,
            'openingHour' => $openingHour,
            'days' => $days,
        ]);
    }
}
