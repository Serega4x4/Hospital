<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use App\Http\Requests\Patient\StoreRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;


class StoreAppointmentController extends Controller
{
    public function __invoke(StoreRequest $request): RedirectResponse
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        if (!auth()->user()->hasRole('patient')) {
            return redirect()->route('dashboard');
        }

        $validatedData = $request->validated();

        $validatedData['password'] = bcrypt($validatedData['password']);

        return redirect()->route('patient.index')->with('success', 'Appointment created successfully!');
    }
}
