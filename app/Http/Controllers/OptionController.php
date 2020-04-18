<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Option;

class OptionController extends Controller
{
    protected $option;

    public function __construct()
    {
        $this->option = new Option();
    }

    public function getOptionGeneral()
    {
        $option = $this->option->getAllOption();
        return view('admin.settings.options', ['options' => $option]);
    }
}
