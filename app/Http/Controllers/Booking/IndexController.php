<?php

namespace App\Http\Controllers\Booking;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class IndexController extends Controller
{
    public function __invoke(): View
    {
        $doctors = Doctor::with('user')->get();
        $patient = Auth::user()->patient;

        $appointments = $patient->appointments()->with('doctor.user')->get();

        return view('booking.index', ['doctors' => $doctors, 'appointments' => $appointments]);
    }
}
