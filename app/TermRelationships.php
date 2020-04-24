<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TermRelationships extends Model
{
    /**
     * @var string
     */
    protected $table = 'term_relationships';

    /**
     * @var array
     */
    protected $primaryKey = [
        'object_id',
        'term_taxonomy_id'
    ];

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @var bool
     */
    public $incrementing = false;


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function post()
    {
        return $this->belongsTo(Post::class, 'object_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function taxonomy()
    {
        return $this->belongsTo(Taxonomy::class, 'term_taxonomy_id');
    }


    //remove
    function get_term($object_id)
    {
        return $this
            ->join('posts', 'posts.ID', '=', 'term_relationships.object_id')
            ->join('terms', 'terms.term_id', '=', 'term_relationships.term_taxonomy_id')
            ->where('object_id', $object_id)->get();
    }

    function get_term_id_by_object_id($object_id)
    {
        return $this->where('object_id', $object_id)->get();
    }

}
