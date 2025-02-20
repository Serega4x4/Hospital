<?php

namespace App\Http\Controllers\Admin\Doctor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function __invoke()
    {
        return 'hello';
    }
}
