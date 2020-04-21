<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UploadController extends Controller
{
    function getUploadNew()
    {
        return view('admin.uploads.upload-new');
    }
}
