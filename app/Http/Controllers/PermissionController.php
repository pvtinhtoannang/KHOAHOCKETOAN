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
            [
                'getAllPermissionWithPaginate' => $getAllPermissionWithPaginate,
                'getAllRole' => $getAllRole,
                'getAllGroup' => $getAllGroup,
                'getAllUser' => $getAllUser
            ]);
    }

    public function addPermission(Request $request)
    {
        if (!empty($request->name) && !empty($request->display_name) && !empty($request->group_id)) {
            if ($this->permission->createPermission($request->name, $request->display_name, $request->group_id)) {
                return redirect()->back()->with('messages', 'Thêm quyền mới thành công!');
            }
        } else {
            return redirect()->back()->withInput()->with('messages', 'Thêm quyền mới thất bại');
        }
    }


    public function getPermissionByID($id)
    {
        if (!empty($id)) {
            return $this->permission->getPermissionByID($id);
        } else {
            return false;
        }

    }

    public function updatePermissionByID(Request $request)
    {

    }

    public function updatePermissionForRole(Request $request)
    {
        $permission_id = $request->permission_for_role;
        $role = $request->role;
        if (!empty($permission_id)) {
            $this->role->updatePermissionForRole($role, $permission_id);
        }
        return redirect()->route('GET_PERMISSION_SETTINGS');
    }

    public function getPermissionByRole($role_id)
    {
        return $this->role->getPermissionByRole($role_id);
    }


}
