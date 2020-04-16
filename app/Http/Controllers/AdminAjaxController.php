<?php

namespace App\Http\Controllers;

use App\Terms;
use Illuminate\Http\Request;

class AdminAjaxController extends Controller
{
    private $term;

    public function __construct()
    {
        $this->term = new Terms();
    }

    public function index()
    {
        return 0;
    }

    function checkSlug(Request $request)
    {
        echo json_encode($this->term->checkSlugExists($request->slug));
        exit;
    }
}
