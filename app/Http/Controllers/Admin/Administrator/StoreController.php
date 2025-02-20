<?php
namespace App\Http\Controllers\Admin\Administrator;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Administrator\StoreRequest;
use App\Models\User;
use Spatie\Permission\Models\Role;

class StoreController extends Controller
{
    public function __invoke(StoreRequest $request)
    {
        $validatedData = $request->validated();

        $validatedData['password'] = bcrypt($validatedData['password']);

        $user = User::create($validatedData);

        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $user->assignRole($adminRole);

        return redirect()->route('admin.administrator.index')->with('success', 'Administrator created successfully.');
    }
}