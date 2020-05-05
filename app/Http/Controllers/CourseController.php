<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CourseController extends Controller
{
    function index($status = null){
        return view('admin.course.course.course');
    }
}
