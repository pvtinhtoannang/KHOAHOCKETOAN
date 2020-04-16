<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Terms extends Model
{
    protected $table = 'terms';
    public $timestamps = false;
    protected $fillable = [
        'term_id',
        'name',
        'slug',
        'term_group'
    ];

    function get_all_term_by_taxonomy($taxonomy = null)
    {
        if ($taxonomy == '') {
            return 0;
        }
        return $this->join('term_taxonomy', 'term_taxonomy.term_id', '=', 'terms.term_id')->where('term_taxonomy.taxonomy', $taxonomy)->get();
    }

    function add_new_term($name = null, $slug = null, $term_group = null)
    {
        return $this->create(['name' => $name, 'slug' => $slug, 'term_group' => $term_group]);
    }

    function get_term_by_slug($slug = null)
    {
        if ($slug == '') {
            return 0;
        }
        return $this->where('slug', $slug)->first();
    }

    function checkSlugExists($slug = null)
    {
        $check = $this->where('slug', '=', $slug)->first();
        if (is_null($check)) {
            return false;
        } else {
            return true;
        }
    }
}
