<?php

namespace App\Http\Controllers;

use App\Post;
use App\PostMeta;
use App\TermRelationships;
use App\Terms;
use App\TermTaxonomy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    private $term, $term_taxonomy, $post_type, $post, $post_meta, $term_relationships, $post_name_num;

    public function __construct()
    {
        $this->post_type = 'post';
        $this->term = new Terms();
        $this->term_taxonomy = new TermTaxonomy();
        $this->post = new Post();
        $this->term_relationships = new TermRelationships();
        $this->post_name_num = 1;
        $this->post_meta = new PostMeta();
    }

    function getPostNew()
    {
        return view('admin.post.post-new');
    }

    function getPostAll()
    {
        $posts = $this->post->get_posts();
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
        if (!empty($request->post_content) || $request->post_content === null) {
            $post_content = '';
        } else {
            $post_content = $request->post_content;
        }

        if (!empty($request->excerpt) || $request->excerpt === null) {
            $excerpt = '';
        } else {
            $excerpt = $request->post_content;
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
    }
}
