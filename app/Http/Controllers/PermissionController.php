<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PermissionController extends Controller
{


    public function getPermission()
    {
        return view('admin.settings.permissions');
    }
}
