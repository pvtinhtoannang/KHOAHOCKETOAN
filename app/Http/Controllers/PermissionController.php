<?php

namespace App\Http\Controllers;

use App\Permission;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    protected $permission;

    public function __construct()
    {
        $this->permission = new Permission();
    }

    public function getPermission()
    {
        $getAllPermissionWithPaginate = $this->permission->getAllPermission();
        return view('admin.settings.permissions', ['getAllPermissionWithPaginate' => $getAllPermissionWithPaginate]);
    }
}
