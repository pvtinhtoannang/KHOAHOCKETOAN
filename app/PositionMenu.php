<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PositionMenu extends Model
{

    protected $table = 'positions_menu';
    protected $fillable = ['name', 'display_name'];
    public function menu()
    {
        return $this->hasMany('App\Menu');
    }
}
