<?php
namespace App\Http\Controllers\Admin\Doctor;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Administrator\StoreRequest;
use App\Models\Doctor;
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

        $doctor = Doctor::create([
            'speciality' => $request->speciality,
            'user_id' => $user->id,
        ]);

        $doctorRole = Role::firstOrCreate(['name' => 'doctor']);
        $user->assignRole($doctorRole);

        return redirect()->route('admin.doctor.index')->with('success', 'Doctor created successfully.');
    }
}