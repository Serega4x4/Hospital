<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class CreateAppointmentController extends Controller
{
    public function __invoke(): View | RedirectResponse
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        if (!auth()->user()->hasRole('patient')) {
            return redirect()->route('dashboard');
        }

        $doctors = Doctor::with('openingHours')->get();

        return view('patient.create_appointment', ['doctors' => $doctors]);
    }
}
