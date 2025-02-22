<?php

namespace App\Http\Controllers\Admin\Patient;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Patient\StoreRequest;
use App\Models\Patient;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;

class StoreController extends Controller
{
    public function __invoke(StoreRequest $request): RedirectResponse
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }



        if (!auth()->user()->hasRole('superadmin|admin')) {
            return redirect()->route('dashboard');
        }

        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'pesel' => $request->pesel,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        $patient = Patient::create([
            'address' => $request->address,
            'medical_history' => $request->medical_history,
            'user_id' => $user->id,
        ]);

        $patientRole = Role::firstOrCreate(['name' => 'patient']);
        $user->assignRole($patientRole);

        return redirect()->route('admin.patient.index')->with('success', 'Patient created successfully.');
    }
}