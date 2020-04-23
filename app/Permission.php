<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{

    /**
     * Relationship to Role Table
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles()
    {
        return $this->belongsToMany('App\Role', 'role_permission', 'permission_id', 'role_id');
    }


    public function groups(){
        return $this->belongsToMany('App\Group');
    }

        /**
         * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
         */
    public function getAllPermissionWithPaginate($paginate = 15)
{
    return self::paginate($paginate);
}

    public function getAllPermission()
    {
        return self::get();
    }
}
