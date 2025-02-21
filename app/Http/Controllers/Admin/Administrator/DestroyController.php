<?php

namespace App\Http\Controllers\Admin\Administrator;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class DestroyController extends Controller
{
    public function __invoke($id): RedirectResponse
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        
        if (!auth()->user()->hasRole('superadmin|admin')) {
            return redirect()->route('dashboard');
        }

        $admin = User::find($id);
        if (!$admin) {
            return redirect()->route('admin.administrator.index');
        }
        $admin->delete();

        return redirect()->route('admin.administrator.index');
    }
}
