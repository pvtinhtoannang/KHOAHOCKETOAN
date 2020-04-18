<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{


    /**
     * Relattionship to User table
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
