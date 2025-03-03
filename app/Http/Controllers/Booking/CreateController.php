<?php

namespace App\Http\Controllers\Booking;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CreateController extends Controller
{
    public function __invoke($doctorId): View
    {
        $doctor = User::find($doctorId);
        $doctorBook = Doctor::find($doctor->doctor->id);

        return view('booking.create', ['doctor' => $doctor, 'doctorBook' => $doctorBook]);
    }
}
