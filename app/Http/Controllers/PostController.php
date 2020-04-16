<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{
    function getPostNew()
    {
        return view('admin.post.post-new');
    }

    function getPostALL()
    {
        return view('admin.post.post-all');
    }
}
