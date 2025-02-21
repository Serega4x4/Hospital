<?php
namespace App\Http\Controllers\Admin\Administrator;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Administrator\UpdateRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;

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
            return redirect()->route('admin.administrator.index')->with('error', 'User not found.');
        }

        $validatedData = $request->validated();
        if (isset($validatedData['password'])) {
            $validatedData['password'] = bcrypt($validatedData['password']);
        }

        $user->update($validatedData);

        return redirect()->route('admin.administrator.index')->with('success', 'Administrator created successfully.');
    }
}
