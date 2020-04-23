<?php

namespace App\Http\Controllers;

use App\Terms;
use App\Taxonomy;
use Illuminate\Http\Request;

class TagController extends Controller
{
    private $term, $taxonomy, $term_taxonomy;

    public function __construct()
    {
        $this->taxonomy = 'post_tag';
        $this->term = new Terms();
        $this->term_taxonomy = new Taxonomy();
    }

    function getTag()
    {
        $tags = $this->term->get_all_term_by_taxonomy($this->taxonomy);
        return view('admin.taxonomy.tag.tag', ['tagData' => $tags]);
    }

    function postAddNewTag(Request $request)
    {
        if ($request->tag_name != null && $request->tag_slug != null) {
            if (!$this->term->checkSlugExists($request->tag_slug)) {
                if ($this->term->add_new_term($request->tag_name, $request->tag_slug, 0)) {
                    $get_term = $this->term->get_term_by_slug($request->tag_slug);
                    $term_id = $get_term['term_id'];
                    if ($request->tag_description == null) {
                        $tag_description = '';
                    } else {
                        $tag_description = $request->tag_description;
                    }
                    $this->term_taxonomy->add_new_term_taxonomy($term_id, $this->taxonomy, $tag_description, 0);
                    return redirect()->route('GET_TAG_ROUTE')->with('messages', 'success');
                } else {
                    return redirect()->route('GET_TAG_ROUTE')->with('messages', 'error');
                }
            } else {
                return redirect()->route('GET_TAG_ROUTE')->with('messages', 'error');
            }
        } else {
            return redirect()->route('GET_TAG_ROUTE')->with('messages', 'error');
        }
    }
}
