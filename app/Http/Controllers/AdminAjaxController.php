<?php

namespace App\Http\Controllers;

use App\Post;
use App\Terms;
use Illuminate\Http\Request;

class AdminAjaxController extends Controller
{
    private $term, $post;

    public function __construct()
    {
        $this->term = new Terms();
        $this->post = new Post();
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

    function checkPostName(Request $request)
    {
        echo json_encode($this->post->checkPostNameExists($request->post_name));
        exit;
    }
}
