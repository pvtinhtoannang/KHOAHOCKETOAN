<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'posts';
    protected $primaryKey = 'ID';
    protected $fillable = [
        'ID',
        'post_author',
        'post_content',
        'post_title',
        'post_excerpt',
        'post_status',
        'post_name',
        'post_type'
    ];

    function checkPostNameExists($post_name = null)
    {
        $check = $this->where('post_name', '=', $post_name)->first();
        if (is_null($check)) {
            return false;
        } else {
            return true;
        }
    }

    function checkPostExists($post_id = null, $post_type = null)
    {
        $check = $this->where('ID', '=', $post_id)->where('post_type', '=', $post_type)->first();
        if (is_null($check)) {
            return false;
        } else {
            return $check;
        }
    }

    function createNewPost($post_author = null, $post_content = null, $post_title = null, $post_excerpt = null, $post_status = null, $post_name = null, $post_type = null)
    {
        return $this->create(['post_author' => $post_author, 'post_content' => $post_content, 'post_title' => $post_title, 'post_excerpt' => $post_excerpt, 'post_status' => $post_status, 'post_name' => $post_name, 'post_type' => $post_type]);
    }

    function get_post_by_post_name($post_name = null)
    {
        if ($post_name == '') {
            return 0;
        }
        return $this->where('post_name', $post_name)->first();
    }

    function get_posts($post_type = 'post')
    {
        return $this->join('users', 'users.ID', '=', 'posts.post_author')
            ->where('post_status', '!=', 'trash')
            ->where('post_type', $post_type)->get();
    }

    function get_post($post_type = 'post', $post_id = null)
    {
        return $this->join('users', 'users.ID', '=', 'posts.post_author')
            ->where('post_status', '!=', 'trash')
            ->where('post_type', $post_type)
            ->where('posts.ID', $post_id)
            ->first();
    }


}
