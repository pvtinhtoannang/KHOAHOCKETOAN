<?php

namespace App\Http\Controllers;
use App\User;
use App\Role;
use App\Group;
use App\Permission;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    protected $permission, $role, $group, $user;

    public function __construct()
    {
        $this->permission = new Permission();
        $this->role = new Role();
        $this->group = new Group();
        $this->user = new User();
    }

    public function getPermission()
    {
        $getAllPermissionWithPaginate = $this->permission->getAllPermission();
        $getAllRole = $this->role->getAllRole();
        $getAllGroup = $this->group->getAllGroup();
        $getAllUser = $this->user->getAllUser();
        return view('admin.settings.permissions',
            ['getAllPermissionWithPaginate' =>
                $getAllPermissionWithPaginate,
                'getAllRole' =>  $getAllRole,
                'getAllGroup' => $getAllGroup,
                'getAllUser' => $getAllUser
            ]);
    }

}
