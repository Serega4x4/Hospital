<?php

namespace App\Http\Controllers\Admin\Doctor;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use App\Models\User;
use Illuminate\View\View;

class IndexController extends Controller
{
    public function __invoke(): View
    {
        $doctors = User::role('doctor')
            ->with('doctor') // Загружаем связанные данные доктора
            ->get();

        return view('admin.doctor.index', ['doctors' => $doctors]);
    }
}
