<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    function getCategory(){
        return view('admin.category.category');
    }
}
