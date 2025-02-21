<?php

namespace App\Http\Controllers\Admin\Administrator;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class EditController extends Controller
{
    public function __invoke($id): View|RedirectResponse
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        if (!auth()->user()->hasRole('superadmin')) {
            return redirect()->route('dashboard');
        }

        $admin = User::find($id);
        if (!$admin) {
            return redirect()->route('admin.administrator.index');
        }

        return view('admin.administrator.edit', ['admin' => $admin]);
    }
}
