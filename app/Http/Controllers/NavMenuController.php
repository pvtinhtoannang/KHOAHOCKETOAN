<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NavMenuController extends Controller
{

    public function getViewNavMenu()
    {
        return view('admin.appearance.nav-menu');
    }
}
