<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    protected $user;

    public function __construct()
    {
        $this->user = new User();
    }

    public function getMyProfile()
    {
        return view('admin.users.my-profile');
    }

    public function updateMyProfile(Request $request)
    {
        $password = $request->password;
        if (!empty($request->email) && !$this->user->checkEmailExists($request->email)) {
            //thay đổi email
            if (!empty($password)) {
                $email = Auth::user()->email;
                $this->user->updatePassword($request->password, 0, $email);
                return redirect()->back()->with('messages', 'Cập nhật thành công!');
            }
        } elseif (!empty($password)) {
            if (strlen($password) < 8) {
                return redirect()->back()->with('messages', 'Mật khẩu quá ngắn!');
            } else {
                $email = Auth::user()->email;
                $this->user->updatePassword($request->password, 0, $email);
                return redirect()->back()->with('messages', 'Đổi mật khẩu thành công!');
            }
        } else {
            return redirect()->back()->with('messages', 'Chưa cập nhật thông tin!');
        }
    }
}
