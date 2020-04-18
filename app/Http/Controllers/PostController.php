<?php

namespace App\Http\Controllers;

use App\Post;
use App\TermRelationships;
use App\Terms;
use App\TermTaxonomy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    private $term, $term_taxonomy, $post_type, $post, $term_relationships;

    public function __construct()
    {
        $this->post_type = 'post';
        $this->term = new Terms();
        $this->term_taxonomy = new TermTaxonomy();
        $this->post = new Post();
        $this->term_relationships = new TermRelationships();
    }

    function getPostNew()
    {
        $category = $this->term->get_all_term_by_taxonomy('category');
        $tag = $this->term->get_all_term_by_taxonomy('tag');
        return view('admin.post.post-new', ['categoryData' => $category]);
    }

    function getPostALL()
    {
        return view('admin.post.post-all');
    }

    function postPostNew(Request $request)
    {
        $user_id = Auth::user()->id;
        $this->post->createNewPost($user_id, $request->post_content, $request->post_title, $request->excerpt, $request->post_status, $request->post_name, $this->post_type);
        $get_post = $this->post->get_post_by_post_name($request->post_name);
        $post_id = $get_post['ID'];
        $termRelationshipsData = array();
        foreach ($request->post_category as $key => $term_id) {
            $termRelationshipsData[$key]['object_id'] = $post_id;
            $termRelationshipsData[$key]['term_taxonomy_id'] = $term_id;
            $termRelationshipsData[$key]['term_order'] = 0;
        }
        $this->term_relationships->addTermRelationships($termRelationshipsData);
    }
}
