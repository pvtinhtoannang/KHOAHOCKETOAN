<?php

namespace App\Http\Controllers;
use App\Role;
use App\Permission;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    protected $permission, $role;

    public function __construct()
    {
        $this->permission = new Permission();
        $this->role = new Role();
    }

    public function getPermission()
    {
        $getAllPermissionWithPaginate = $this->permission->getAllPermission();
        $getAllRole = $this->role->getAllRole();
        return view('admin.settings.permissions', ['getAllPermissionWithPaginate' => $getAllPermissionWithPaginate, 'getAllRole'=>$getAllRole]);
    }
}
