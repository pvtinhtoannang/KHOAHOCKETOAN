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
    protected $table = 'users';

    /**
     * Relationship to Role Table
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles()
    {
        return $this->belongsToMany('App\Role', 'role_user', 'user_id', 'role_id');
    }

    public function permissions()
    {
        return $this->belongsToMany('App\Permission', 'permission_user', 'user_id', 'permission_id');
    }


    /**
     * @param $roles
     * @return bool
     */
    public function authorizeRoles($roles)
    {
        if (is_array($roles)) {
            return $this->hasAnyRole($roles) ||
                abort(401, 'Bạn không có quyền truy cập hành động này!');
        }
        return $this->hasRole($roles) ||
            abort(401, 'Bạn không có quyền truy cập hành động này!');
    }


    /**
     * Check multiple roles
     * @param $roles
     * @return bool
     */
    public function hasAnyRole($roles)
    {
        return null !== $this->roles()->whereIn('name', $roles)->first();
    }


    /**
     * Check one role
     * @param $role
     * @return bool
     */
    public function hasRole($role)
    {
        return null !== $this->roles()->where('name', $role)->first();
    }

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
    public function checkEmailExists($email)
    {
        if (User::where('email', $email)->exists()) {
            return true;
        } else {
            return false;
        }
    }

    public function updateInformation($name, $id)
    {
        return self::find($id)->update(['name' => $name]);
    }


    public function getAllUser()
    {
        return self::orderBy('name', 'ASC')->get();
    }
}
