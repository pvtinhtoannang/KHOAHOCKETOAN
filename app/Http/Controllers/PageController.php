<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PageController extends Controller
{
    private $post_type, $post, $post_name_num;

    public function __construct()
    {
        $this->post_type = 'page';
        $this->post = new Post();
        $this->post_name_num = 1;
    }

    function getPageAll()
    {
        $posts = $this->post->get_posts($this->post_type);
        return view('admin.page.page-all', ['postData' => $posts]);
    }

    function getPageNew()
    {
        return view('admin.page.page-new');
    }

    function autoPostName($post_name)
    {
        if ($this->post->checkPostNameExists($post_name) === false || $this->post->checkPostNameExists($post_name) === null) {
            return $postName = $post_name;
        } else {
            $newPostName = $post_name . '-' . $this->post_name_num++;
            return $this->autoPostName($newPostName);
        }
    }

    function postPageNew(Request $request)
    {
        if (!empty($request->post_content) || $request->post_content === null) {
            $post_content = '';
        } else {
            $post_content = $request->post_content;
        }
        $user_id = Auth::user()->id;
        $post_name = $this->autoPostName($request->post_name);
        $this->post->createNewPost(
            $user_id,
            $post_content,
            $request->post_title,
            '',
            $request->post_status,
            $post_name,
            $this->post_type
        );
    }
}
