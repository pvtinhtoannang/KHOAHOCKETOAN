<?php

namespace App\Http\Controllers;

use App\Page;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PageController extends Controller
{
    private $post_type, $page, $post;

    /**
     * PageController constructor.
     */
    public function __construct()
    {
        $this->post_type = 'page';
        $this->page = new Page();
        $this->post = new Post();
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    function index()
    {
        $pages = $this->page->get();
        return view('admin.page.page-all', ['pages' => $pages]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    function getPageEditor()
    {
        return view('admin.page.page-new', ['post_type' => $this->post_type]);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    function editPage($id)
    {
        $responses = array(
            'title' => 'Lỗi',
            'sub_title' => '',
            'description' => 'Bạn đang muốn sửa một thứ không tồn tại. Có thể nó đã bị xóa?'
        );
        $postData = $this->post->post_id($id)->type($this->post_type)->first();
        if ($postData == null) {
            return view('admin.errors.admin-error', ['error_responses' => $responses]);
        } else {
            return view('admin.page.page-edit', ['postData' => $postData]);
        }
    }

    /**
     * @param Request $request
     */
    function createPage(Request $request)
    {
        if (!empty($request->post_content) || $request->post_content === null) {
            $post_content = '';
        } else {
            $post_content = $request->post_content;
        }
        $user_id = Auth::user()->id;
        $post_name = $this->post->slugGenerator($request->post_name);
        $pageRequest = array(
            'post_author' => $user_id,
            'post_content' => $post_content,
            'post_title' => $request->post_title,
            'post_excerpt' => '',
            'post_status' => $request->post_status,
            'post_name' => $post_name,
            'post_type' => $this->post_type
        );
        $this->page->create($pageRequest);
    }
}
