<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Patient;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Spatie\Permission\Models\Role;

class RegisteredUserController extends Controller
{
    public function create(): View
    {
        return view('auth.register');
    }

    public function store(Request $request): RedirectResponse
    {
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
            'birthday' => $request->birthday,
            'user_id' => $user->id,
        ]);

        $patientRole = Role::firstOrCreate(['name' => 'patient']);
        $user->assignRole($patientRole);

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('hospital', absolute: false));
    }
}
