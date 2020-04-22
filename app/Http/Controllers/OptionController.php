<?php

namespace App\Http\Controllers;
use App\Http\Requests\OptionGeneralRequest;
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
        foreach ($request->option as $key => $value) {
            foreach ($value as $option_name => $option_value) {
                \App\Option::where('option_name', $option_name)
                    ->update(['option_value' => $option_value]);
                //function updateOptionByOptionName not working
//                $this->option->updateOptionByOptionName();
            }
        }
        return redirect()->back()->with('messages', 'Cập nhật thành công!');
    }

    public function postAddOptionGeneral(OptionGeneralRequest $request)
    {

    }
}
