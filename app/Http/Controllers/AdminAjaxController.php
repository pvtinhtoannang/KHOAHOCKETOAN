<?php

namespace App\Http\Controllers;

use App\Post;
use App\Term;
use App\PostMeta;
use Illuminate\Http\Request;

class AdminAjaxController extends Controller
{
    private $term, $post;

    /**
     * AdminAjaxController constructor.
     */
    public function __construct()
    {
        $this->term = new Term();
        $this->post = new Post();
    }

    /**
     * @return int
     */
    public function index()
    {
        return 0;
    }

    /**
     * @param Request $request
     */
    function slugGenerator(Request $request)
    {
        echo json_encode($this->term->slugGenerator($request->slug));
        exit;
    }

    /**
     * @param Request $request
     */
    function postNameGenerator(Request $request)
    {
        echo json_encode($this->post->slugGenerator($request->post_name));
        exit;
    }
}
