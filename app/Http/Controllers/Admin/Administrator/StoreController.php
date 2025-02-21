<?php
namespace App\Http\Controllers\Admin\Administrator;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Administrator\StoreRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;

class StoreController extends Controller
{
    public function __invoke(StoreRequest $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }



        if (!auth()->user()->hasRole('superadmin')) {
            return redirect()->route('dashboard');
        }

        $validatedData = $request->validated();

        $validatedData['password'] = bcrypt($validatedData['password']);

        $user = User::create($validatedData);

        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $user->assignRole($adminRole);

        return redirect()->route('admin.administrator.index')->with('success', 'Administrator created successfully.');
    }
}