<?php

namespace App\Http\Controllers\Admin\Patient;

use App\Http\Controllers\Controller;
use App\Models\Patient;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ShowController extends Controller
{
    public function __invoke($id): View | RedirectResponse
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        
        if (!auth()->user()->hasRole('superadmin|admin')) {
            return redirect()->route('dashboard');
        }

        $patient = User::find($id);
        if (!$patient) {
            return redirect()->route('admin.patient.index');
        }
        $patientMHA = Patient::find($patient->patient->id);
        $date = Carbon::parse(($patientMHA->birthday))->format('d.m.Y');

        return view('admin.patient.show', ['patient' => $patient, 'patientMHA' => $patientMHA, 'date' => $date]);
    }
}
