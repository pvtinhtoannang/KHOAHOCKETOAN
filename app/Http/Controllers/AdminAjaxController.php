<?php

namespace App\Http\Controllers;

use App\Post;
use App\Term;
use App\PostMeta;
use Illuminate\Http\Request;

class AdminAjaxController extends Controller
{
    private $term, $post;

    public function __construct()
    {
        $this->term = new Term();
        $this->post = new Post();
    }

    public function index()
    {
        return 0;
    }

    function slugGenerator(Request $request)
    {
        echo json_encode($this->term->slugGenerator($request->slug));
        exit;
    }

    function postNameGenerator(Request $request)
    {
        echo json_encode($this->post->slugGenerator($request->post_name));
        exit;
    }
}
