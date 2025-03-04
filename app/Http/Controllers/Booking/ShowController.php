<?php

namespace App\Http\Controllers\Booking;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use Illuminate\View\View;

class ShowController extends Controller
{
    public function __invoke(Appointment $appointment): View
    {
        return view('booking.show', ['appointment' => $appointment]);
    }
}
