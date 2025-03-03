<?php

namespace App\Http\Controllers\Booking;

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

        return view('booking.index', ['doctors' => $doctors]);
    }
}
