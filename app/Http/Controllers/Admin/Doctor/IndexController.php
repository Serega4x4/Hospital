<?php

namespace App\Http\Controllers\Admin\Doctor;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\View\View;

class IndexController extends Controller
{
    public function __invoke(): View
    {
        $doctors = User::role('doctor')
            ->with('doctor')
            ->get();

        return view('admin.doctor.index', ['doctors' => $doctors]);
    }
}
