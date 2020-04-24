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
}
