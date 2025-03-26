<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\View\View;

class StoreAppointmentController extends Controller
{
    public function __invoke(): View
    {
        $doctors = User::role('doctor')
            ->with('doctor')
            ->get();

        return view('patient.index', ['doctors' => $doctors]);
    }
}
