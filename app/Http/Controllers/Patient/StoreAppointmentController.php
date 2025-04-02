<?php

namespace App\Http\Controllers\Patient;

use App\Http\Requests\Patient\StoreRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class StoreAppointmentController extends BaseController
{
    public function __invoke(StoreRequest $request): RedirectResponse
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        if (!auth()->user()->hasRole('patient')) {
            return redirect()->route('dashboard');
        }

        $validated = $request->validated();

        $appointment = $this->service->store($validated);

        return redirect()->route('patient.index')->with('success', 'Appointment created successfully!');
    }
}