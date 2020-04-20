<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TermRelationships extends Model
{
    protected $table = 'term_relationships';
    public $timestamps = false;
    protected $fillable = [
        'object_id',
        'term_taxonomy_id',
        'term_order'
    ];

    function addTermRelationships($termRelationshipsData = null)
    {
        if (!empty($termRelationshipsData)) {
            $this->insert($termRelationshipsData);
        }
    }

    function get_term($object_id)
    {
        return $this
            ->join('posts', 'posts.ID', '=', 'term_relationships.object_id')
            ->join('terms', 'terms.term_id', '=', 'term_relationships.term_taxonomy_id')
            ->where('object_id', $object_id)->get();
    }

}
