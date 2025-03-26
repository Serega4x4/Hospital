<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ShowAppointmentController extends Controller
{
    public function __invoke(): View
    {
        $user = Auth::user();

        $appointments = $user->patient->appointments()->with('doctor.user')->orderBy('start_time', 'asc')->get();

        $appointments = $user->patient->appointments()->with('doctor.user')->where('start_time', '>=', now())->orderBy('start_time', 'asc')->get();

        return view('patient.show_appointment', ['appointments' => $appointments]);
    }
}
