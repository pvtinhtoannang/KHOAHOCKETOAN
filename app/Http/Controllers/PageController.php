<?php

namespace App\Http\Controllers;

use App\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PageController extends Controller
{
    private $post_type, $page;

    /**
     * PageController constructor.
     */
    public function __construct()
    {
        $this->post_type = 'page';
        $this->page = new Page();
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    function index()
    {
        $pages = $this->page->latest()->get();
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
    function getEditPage($id)
    {
        $responses = array(
            'title' => 'Lỗi',
            'sub_title' => '',
            'description' => 'Bạn đang muốn sửa một thứ không tồn tại. Có thể nó đã bị xóa?'
        );
        $postData = $this->page->post_id($id)->type($this->post_type)->first();
        if ($postData == null) {
            return view('admin.errors.admin-error', ['error_responses' => $responses]);
        } else {
            return view('admin.page.page-edit', ['postData' => $postData]);
        }
    }

    /**
     * @param $str
     * @return string|string[]|null
     */
    function toSlug($str)
    {
        $str = trim(mb_strtolower($str));
        $str = preg_replace('/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/', 'a', $str);
        $str = preg_replace('/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/', 'e', $str);
        $str = preg_replace('/(ì|í|ị|ỉ|ĩ)/', 'i', $str);
        $str = preg_replace('/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/', 'o', $str);
        $str = preg_replace('/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/', 'u', $str);
        $str = preg_replace('/(ỳ|ý|ỵ|ỷ|ỹ)/', 'y', $str);
        $str = preg_replace('/(đ)/', 'd', $str);
        $str = preg_replace('/[^a-z0-9-\s]/', '', $str);
        $str = preg_replace('/([\s]+)/', '-', $str);
        return $str;
    }

    /**
     * @param $request
     * @return array
     */
    function thumbnailRequest($request)
    {
        return array(
            'meta_key' => 'thumbnail_id',
            'meta_value' => $request->thumbnail_id,
        );
    }

    /**
     * @param $request
     * @param string $id
     * @return array
     */
    function pageRequest($request, $id = '')
    {
        $post_content = '';
        if (isset($request->post_content)) {
            $post_content = $request->post_content;
        }
        $user_id = Auth::user()->id;
        if ($id !== '') {
            $post_name = $request->post_name;
        } else {
            $post_name = $this->page->slugGenerator($this->toSlug($request->post_title));
        }
        return array(
            'post_author' => $user_id,
            'post_content' => $post_content,
            'post_title' => $request->post_title,
            'post_excerpt' => '',
            'post_status' => $request->post_status,
            'post_name' => $post_name,
            'post_type' => $this->post_type
        );
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    function createPage(Request $request)
    {
        $page = $this->page->create($this->pageRequest($request));
        if (isset($request->thumbnail_id)) {
            $page->meta()->create($this->thumbnailRequest($request));
        }
        return redirect()->route('GET_EDIT_PAGE_ROUTE', $page)->with('create', 'Trang đã được tạo.');
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    function updatePage(Request $request, $id)
    {
        $page = $this->page->find($id);
        $page->update($this->pageRequest($request, $id));
        if ($page->thumbnail === null) {
            if (isset($request->thumbnail_id)) {
                $page->meta()->create($this->thumbnailRequest($request));
            }
        } else {
            if (isset($request->thumbnail_id)) {
                $page->meta()->update($this->thumbnailRequest($request));
            } else {
                $thumbnail = $page->meta()->find($page->thumbnail->meta_id);
                $thumbnail->delete();
            }
        }
        return redirect()->route('GET_EDIT_PAGE_ROUTE', [$id])->with('update', 'Trang đã được cập nhật.');
    }
}
