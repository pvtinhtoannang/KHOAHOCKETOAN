<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    function getAdminDashboard()
    {
        return view('admin.dashboard.dashboard-home');
    }
}
