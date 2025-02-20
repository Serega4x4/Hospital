<?php

namespace App\Http\Controllers\Admin\Administrator;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class CreateController extends Controller
{
    public function __invoke(): View
    {
        return view('admin.administrator.create');
    }
}
