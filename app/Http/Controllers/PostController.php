<?php

namespace App\Http\Controllers;

use App\Post;
use App\TermRelationships;
use App\Term;
use App\Taxonomy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    private $term, $term_taxonomy, $post_type, $post, $term_relationships;

    /**
     * PostController constructor.
     */
    public function __construct()
    {
        $this->post_type = 'post';
        $this->term = new Term();
        $this->term_taxonomy = new Taxonomy();
        $this->post = new Post();
        $this->term_relationships = new TermRelationships();
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    function index()
    {
        $posts = $this->post->type($this->post_type)->get();
        return view('admin.post.post-all', ['postData' => $posts]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    function getPostEditor()
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
    }

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
     * @param Request $request
     */
    function createPost(Request $request)
    {
        $tags = explode(',', $request->post_tag);
        $tagData = array();
        $catData = array();
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
        $post_name = $this->post->slugGenerator($request->post_name);
        $postRequest = array(
            'post_author' => $user_id,
            'post_content' => $post_content,
            'post_title' => $request->post_title,
            'post_excerpt' => $excerpt,
            'post_status' => $request->post_status,
            'post_name' => $post_name,
            'post_type' => $this->post_type
        );
        $metaRequest = array(
            'meta_key' => 'thumbnail_id',
            'meta_value' => $request->thumbnail_id,
        );
        foreach ($tags as $key => $tag) {
            if ($tag !== '') {
                $tagCheck = $this->term->slug($this->toSlug($tag))->first();
                if ($tagCheck == null) {
                    $termRequest = array(
                        'name' => $tag,
                        'slug' => $this->toSlug($tag),
                        'term_group' => 0
                    );
                    $term = $this->term->create($termRequest);
                    if ($term) {
                        $tagData[$key]['term_taxonomy_id'] = $term->term_id;
                        $taxonomyRequest = array(
                            'taxonomy' => 'post_tag',
                            'description' => '',
                            'parent' => 0,
                            'count' => 0
                        );
                        $term->taxonomy()->create($taxonomyRequest);
                    }
                } else {
                    $tagData[$key]['term_taxonomy_id'] = $tagCheck->term_id;
                }
            }
        }
        foreach ($cats as $key => $term_id) {
            $catData[$key]['term_taxonomy_id'] = $term_id;
        }
        $taxonomy = array_merge($catData, $tagData);
        $post = $this->post->create($postRequest);
        $post->meta()->create($metaRequest);
        $post->taxonomies()->attach($taxonomy);
    }
}
