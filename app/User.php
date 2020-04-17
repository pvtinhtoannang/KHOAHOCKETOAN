<?php

namespace App;
use Illuminate\Support\Facades\Hash;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * @param $newPassword
     * @param int $user
     * @param string $email
     * @return bool|\Exception
     */
    public function updatePassword($newPassword, $user = 0, $email = '')
    {
        try {
            if (!empty($newPassword)) {
                if (!empty($email) || !User::where('email', $email)->exists()) {
                    return User::where('email', $email)->update(['password' => Hash::make($newPassword)]);
                } elseif ($user != 0) {
                    return User::find($user)->update(['password' => Hash::make($newPassword)]);
                } else {
                    return false;
                }
            } else {
                return false;
            }
        } catch (\Exception $e) {
            return $e;
        }
    }

    /**
     * @param $email
     * @param $newEmail
     * @return bool
     */
    public function changeEmail($email, $newEmail)
    {
        if (!empty($email) || !User::where('email', $email)->exists()) {
            $user = self::where('email', $email)->update('email', $newEmail);
            return $user;
        } else {
            return false;
        }
    }

    /**
     * @param $email
     * @return bool
     */
    public function checkEmailExists($email){
        if(User::where('email', $email)->exists()){
            return true;
        }else{
            return false;
        }
    }
}
