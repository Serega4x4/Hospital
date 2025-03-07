<?php

namespace App\Http\Controllers\Admin\Doctor;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class CreateController extends Controller
{
    public function __invoke(): View | RedirectResponse
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        if (!auth()->user()->hasRole('superadmin|admin')) {
            return redirect()->route('dashboard');
        }

        $days = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'];
        $defaultHours = [
            'monday' => ['08:00-12:00', '13:00-17:00'],
            'tuesday' => ['08:00-12:00', '13:00-17:00'],
            'wednesday' => ['08:00-12:00', '13:00-17:00'],
            'thursday' => ['08:00-12:00', '13:00-17:00'],
            'friday' => ['08:00-12:00', '13:00-17:00'],
            'saturday' => [],
            'sunday' => [],
        ];

        return view('admin.doctor.create', [
            'defaultHours' => $defaultHours,
            'days' => $days,
        ]);
    }
}
