<?php

namespace App\Http\Controllers;

use App\Post;
use App\PostMeta;
use App\TermRelationships;
use App\Term;
use App\Taxonomy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    private $term, $term_taxonomy, $post_type, $post, $post_meta, $term_relationships, $post_name_num;

    public function __construct()
    {
        $this->post_type = 'post';
        $this->term = new Term();
        $this->term_taxonomy = new Taxonomy();
        $this->post = new Post();
        $this->term_relationships = new TermRelationships();
        $this->post_name_num = 1;
        $this->post_meta = new PostMeta();
    }

    function getPostNew()
    {
        return view('admin.post.post-new');
    }

    function getPostEdit()
    {
        $responses = array(
            'title' => 'Lỗi',
            'sub_title' => '',
            'description' => 'Bạn đang muốn sửa một thứ không tồn tại. Có thể nó đã bị xóa?'
        );

        if (isset($_GET['post'])) {
            $post_id = $_GET['post'];
            $get_post = $this->post->checkPostExists($post_id, $this->post_type);
            if ($get_post) {
                return view('admin.post.post-edit', ['postData' => $get_post]);
            } else {
                return view('admin.errors.admin-error', ['error_responses' => $responses]);
            }
        } else {
            return view('admin.errors.admin-error', ['error_responses' => $responses]);
        }
    }

    function getPostAll()
    {
        $posts = $this->post->type($this->post_type)->get();
        return view('admin.post.post-all', ['postData' => $posts]);
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

    function postPostNew(Request $request)
    {
        $post_content = '';
        $excerpt = '';
        if (isset($request->post_content)) {
            $post_content = $request->post_content;
        }

        if (isset($request->excerpt)) {
            $excerpt = $request->excerpt;
        }

        if (empty($request->post_category)) {
            $cats = array("1");
        } else {
            $cats = $request->post_category;
        }
        $user_id = Auth::user()->id;
        $post_name = $this->autoPostName($request->post_name);
        $this->post->createNewPost(
            $user_id,
            $post_content,
            $request->post_title,
            $excerpt,
            $request->post_status,
            $post_name,
            $this->post_type
        );
        $get_post = $this->post->get_post_by_post_name($post_name);
        $post_id = $get_post['ID'];
        $termRelationshipsData = array();
        foreach ($cats as $key => $term_id) {
            $termRelationshipsData[$key]['object_id'] = $post_id;
            $termRelationshipsData[$key]['term_taxonomy_id'] = $term_id;
            $termRelationshipsData[$key]['term_order'] = 0;
        }
        $this->term_relationships->addTermRelationships($termRelationshipsData);
        if (!is_null($request->thumbnail_id)) {
            $metaData = [
                ['post_id' => $post_id, 'meta_key' => 'thumbnail_id', 'meta_value' => $request->thumbnail_id]
            ];
            $this->post_meta->addPostMeta($metaData);
        }
        return redirect()->route('GET_POST_EDIT_ROUTE', 'post=' . $post_id);
    }
}
