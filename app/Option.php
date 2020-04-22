<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Option extends Model
{

    protected $fillable = [
        'option_name',
        'option_value',
        'option_type',
        'option_label'
    ];

    public function getAllOption()
    {
        return self::get();
    }

    public function updateOptionByOptionName($option_name, $option_value)
    {
        $option = $this->where('option_name', $option_name)->first()->update(['option_value', $option_value]);
        return $option;
    }

}
