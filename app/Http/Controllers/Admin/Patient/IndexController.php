<?php

namespace App\Http\Controllers\Admin\Patient;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\View\View;

class IndexController extends Controller
{
    public function __invoke(): View
    {
        $patients = User::role('patient')
            ->with('patient')
            ->get();

        return view('admin.patient.index', ['patients' => $patients]);
    }
}
