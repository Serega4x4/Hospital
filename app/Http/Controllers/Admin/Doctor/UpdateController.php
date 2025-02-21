<?php
namespace App\Http\Controllers\Admin\Doctor;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Doctor\UpdateRequest;
use App\Models\Doctor;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class UpdateController extends Controller
{
    public function __invoke(UpdateRequest $request, $id): RedirectResponse
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        if (!auth()->user()->hasRole('superadmin')) {
            return redirect()->route('dashboard');
        }

        $user = User::find($id);
        if (!$user) {
            return redirect()->route('admin.doctor.index')->with('error', 'User not found.');
        }

        $validatedData = $request->validated();
        if (isset($validatedData['password'])) {
            $validatedData['password'] = bcrypt($validatedData['password']);
        }

        $user->update($validatedData);

        $doctor = Doctor::where('user_id', $user->id)->first();
        $doctor->update(['speciality' => $request->speciality,]);

        return redirect()->route('admin.doctor.index')->with('success', 'Doctor created successfully.');
    }
}
