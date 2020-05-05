<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{

    protected $table = 'menus';
    protected $fillable = ['label', 'link', 'parent', 'sort', 'positions_menu_id'];

    public function positionsMenu()
    {
        return $this->belongsTo('App\PositionMenu', 'positions_menu_id');
    }

    public function menus()
    {
        return $this->hasMany('App\Menu', 'parent', 'id');
    }

    public function childrenMenus()
    {
        return $this->hasMany('App\Menu', 'parent', 'id')->with('menus');
    }
}