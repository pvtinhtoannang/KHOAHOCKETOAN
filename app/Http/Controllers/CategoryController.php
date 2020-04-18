<?php

namespace App\Http\Controllers;

use App\Terms;
use App\TermTaxonomy;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    private $term, $taxonomy, $term_taxonomy;

    public function __construct()
    {
        $this->taxonomy = 'category';
        $this->term = new Terms();
        $this->term_taxonomy = new TermTaxonomy();
    }

    function getCategory()
    {
        $category = $this->term->get_all_term_by_taxonomy($this->taxonomy);
        return view('admin.taxonomy.category.category', ['categoryData' => $category]);
    }

    function postAddNewCategory(Request $request)
    {
        if ($request->category_name != null && $request->category_slug != null) {
            if (!$this->term->checkSlugExists($request->category_slug)) {
                if ($this->term->add_new_term($request->category_name, $request->category_slug, 0)) {
                    $get_term = $this->term->get_term_by_slug($request->category_slug);
                    $term_id = $get_term['term_id'];
                    if ($request->category_description == null) {
                        $category_description = '';
                    } else {
                        $category_description = $request->category_description;
                    }
                    $this->term_taxonomy->add_new_term_taxonomy($term_id, $this->taxonomy, $category_description, $request->category_parent);
                    return redirect()->route('GET_CATEGORY_ROUTE')->with('messages', 'success');
                } else {
                    return redirect()->route('GET_CATEGORY_ROUTE')->with('messages', 'error');
                }
            } else {
                return redirect()->route('GET_CATEGORY_ROUTE')->with('messages', 'error');
            }
        } else {
            return redirect()->route('GET_CATEGORY_ROUTE')->with('messages', 'error');
        }
    }
}
