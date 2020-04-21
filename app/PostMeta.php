<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PostMeta extends Model
{
    protected $table = 'postmeta';
    public $timestamps = false;
    protected $fillable = [
        'meta_id',
        'post_id',
        'meta_key',
        'meta_value'
    ];

    function addPostMeta($postMeta = null)
    {
        if (!empty($postMeta)) {
            $this->insert($postMeta);
        }
    }
}
