<?php

namespace App\Http\Controllers\Admin\Patient;

use App\Http\Controllers\Controller;
use App\Models\Patient;
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

        if (!auth()->user()->hasRole('superadmin')) {
            return redirect()->route('dashboard');
        }

        $patient = User::find($id);
        if (!$patient) {
            return redirect()->route('admin.patient.index');
        }

        $patientHMA = patient::find($patient->patient->id);

        return view('admin.patient.edit', ['patient' => $patient, 'patientHMA' => $patientHMA]);
    }
}
