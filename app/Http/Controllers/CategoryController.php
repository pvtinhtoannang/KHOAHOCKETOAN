<?php

namespace App\Http\Controllers;

use App\Term;
use App\Taxonomy;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    private $term, $tax, $taxonomy;

    public function __construct()
    {
        $this->tax = 'category';
        $this->term = new Term();
        $this->taxonomy = new Taxonomy();
    }

    function fetchCategoryTree($parent = 0, $spacing = '', $user_tree_array = '')
    {
        $get_term = $this->taxonomy->parent_id($parent)->category()->get();
        if (!is_array($user_tree_array))
            $user_tree_array = array();
        if (!empty($get_term)) {
            foreach ($get_term as $term) {
                $user_tree_array[] = array(
                    "term_taxonomy_id" => $term->term->term_taxonomy_id,
                    "term_id" => $term->term->term_id,
                    "name" => $spacing . $term->term->name,
                    "slug" => $term->term->slug,
                    "description" => $term->term->description
                );
                $user_tree_array = $this->fetchCategoryTree($term->term_id, $spacing . '— ', $user_tree_array);
            }
        }
        return $user_tree_array;
    }

    function getCategory()
    {
        return view('admin.taxonomy.category.category', ['categoryData' => $this->fetchCategoryTree()]);
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
                    $this->taxonomy->add_new_term_taxonomy($term_id, $this->tax, $category_description, $request->category_parent);
                    return redirect()->route('GET_CATEGORY_ROUTE')->with('messages', 'success')->withInput();
                } else {
                    return redirect()->route('GET_CATEGORY_ROUTE')->with('messages', 'error')->withInput();
                }
            } else {
                return redirect()->route('GET_CATEGORY_ROUTE')->with('messages', 'error')->withInput();
            }
        } else {
            return redirect()->route('GET_CATEGORY_ROUTE')->with('messages', 'error')->withInput();
        }
    }
}
