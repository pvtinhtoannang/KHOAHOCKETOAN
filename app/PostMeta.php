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

    function get_postmeta($post_id = null)
    {
        return $this->where('post_id', $post_id)->get();
    }

    function get_postmeta_by_meta_key($post_id = null, $meta_key = '')
    {
        return $this->where('post_id', $post_id)->where('meta_key', $meta_key)->first();
    }
}
