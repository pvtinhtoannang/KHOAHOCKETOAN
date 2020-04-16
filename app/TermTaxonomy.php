<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TermTaxonomy extends Model
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

}
