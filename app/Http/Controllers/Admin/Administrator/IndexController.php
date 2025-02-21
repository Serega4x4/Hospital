<?php

namespace App\Http\Controllers\Admin\Administrator;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\View\View;

class IndexController extends Controller
{
    public function __invoke(): View
    {
        $admins = User::role('admin')->get();

        return view('admin.administrator.index', ['admins' => $admins]);
    }
}
