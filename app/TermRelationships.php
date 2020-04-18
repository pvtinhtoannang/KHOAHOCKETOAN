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
}
