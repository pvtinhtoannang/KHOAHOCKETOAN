<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    public function permission()
    {
        return $this->hasMany('App\Permission');
    }

    public function getAllGroup(){
        return $this->get();
    }
}
