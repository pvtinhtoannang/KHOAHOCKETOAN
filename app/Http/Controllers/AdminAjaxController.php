<?php

namespace App\Http\Controllers;

use App\Post;
use App\Terms;
use App\PostMeta;
use App\Permission;
use Illuminate\Http\Request;

class AdminAjaxController extends Controller
{
    private $term, $post, $post_meta, $permission;

    public function __construct()
    {
        $this->term = new Terms();
        $this->post = new Post();
        $this->post_meta = new PostMeta();
        $this->permission = new Permission();
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

    function getAttachedFile(Request $request)
    {
        $attached_meta = $this->post_meta->get_postmeta_by_meta_key($request->id, '_attached_file');
        $uploads_url = url('/contents/uploads');
        $file_url = $uploads_url . '/' . $attached_meta['meta_value'];
        echo json_encode($file_url);
        exit;
    }

    function getPermissionAll(Request $request)
    {
        echo json_encode($this->permission->getAllPermission());
        exit;
    }
}
