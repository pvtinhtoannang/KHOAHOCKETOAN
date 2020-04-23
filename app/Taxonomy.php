<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Taxonomy extends Model
{
    protected $table = 'term_taxonomy';
    public $timestamps = false;
    protected $fillable = [
        'term_taxonomy_id',
        'term_id',
        'taxonomy',
        'description',
        'parent',
        'count'
    ];

    function add_new_term_taxonomy($term_id = null, $taxonomy = null, $description = null, $parent = null)
    {
        return $this->create(['term_id' => $term_id, 'taxonomy' => $taxonomy, 'description' => $description, 'parent' => $parent, 'count' => 0]);
    }

    function get_term_by_parent($parent = null, $taxonomy = null)
    {
        return $this->join('terms', 'terms.term_id', '=', 'term_taxonomy.term_id')
            ->where('taxonomy', $taxonomy)
            ->where('parent', $parent)
            ->orderBy('term_taxonomy_id', 'asc')->get();
    }
}
