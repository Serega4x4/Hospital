<?php

namespace App\Http\Controllers\Admin\Administrator;

use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    public function __invoke()
    {
        return 'administrator';
    }
}
