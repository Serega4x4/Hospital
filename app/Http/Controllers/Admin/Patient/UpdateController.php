<?php
namespace App\Http\Controllers\Admin\Patient;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Patient\UpdateRequest;
use App\Models\Patient;
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
            return redirect()->route('admin.patient.index')->with('error', 'User not found.');
        }

        $validatedData = $request->validated();
        if (isset($validatedData['password'])) {
            $validatedData['password'] = bcrypt($validatedData['password']);
        }

        $user->update($validatedData);

        $patient = Patient::where('user_id', $user->id)->first();
        $patient->update([
            'address' => $request->address,
            'medical_history' => $request->medical_history,
            'birthday' => $request->birthday,
    ]);

        return redirect()->route('admin.patient.index')->with('success', 'Patient created successfully.');
    }
}
