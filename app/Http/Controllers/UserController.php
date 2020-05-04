<?php

namespace App\Http\Controllers;

use App\User;
use App\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    protected $user, $role;

    public function __construct()
    {
        $this->user = new User();
        $this->role = new Role();
    }

    public function getMyProfile(Request $request)
    {
//        $request->user()->authorizeRoles(['administrator']);
        return view('admin.users.my-profile');
    }

    public function updateMyProfile(Request $request)
    {
        $password = $request->password;
        $email = Auth::user()->email;
        $this->user->updateInformation($request->name, Auth::user()->id);
        if (!empty($request->email) && !$this->user->checkEmailExists($request->email)) {
            //thay đổi email
            if (!empty($password)) {
                $this->user->updatePassword($request->password, 0, $email);
                return redirect()->back()->with('messages', 'Cập nhật thành công!');
            }
        } elseif (!empty($password)) {
            if (strlen($password) < 8) {
                return redirect()->back()->with('messages', 'Mật khẩu quá ngắn!');
            } else {
                $this->user->updatePassword($request->password, 0, $email);
                return redirect()->back()->with('messages', 'Đổi mật khẩu thành công!');
            }
        } else {
            return redirect()->back()->with('messages', 'Cập nhật thông tin thành công!');
        }
    }

    public function getAllUser()
    {
        $data_user = $this->user->getAllUser();
        $data_role = $this->role->getAllRole();
        return view('admin.users.all-user', ['dataUsers' => $data_user, 'dataRole' => $data_role]);
    }

    public function addNewUser(Request $request)
    {
        if (!empty($request->name) && !empty($request->email) && !empty($request->password)) {
            $user = $this->user->addNewUser($request->name, $request->email, $request->password, $request->role_id);
            return redirect()->back()->with('messages', 'Cập nhật thông tin thành công!');
        } else {
            return redirect()->back()->with('messages', 'Cập nhật thông tin thất bại!');
        }
    }

}
