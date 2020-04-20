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

    public function postUpdateOptionGeneral(Request $request)
    {
        foreach ($request->option as $value) {
            foreach ($value as $option_name => $option_value) {
                $this->option->updateOptionByOptionName($option_name, $option_value);
            }
        }
        return redirect()->back()->with('messages', 'Cập nhật thành công!');
    }
}
