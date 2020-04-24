<?php

namespace App;

use App\Builder\PostBuilder;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    /**
     * @var string
     */
    protected $table = 'posts';

    /**
     * @var string
     */
    protected $primaryKey = 'ID';

    /**
     * @var array
     */
    protected static $postTypes = [];

    /**
     * @var array
     */
    protected $fillable = [
        'post_author',
        'post_content',
        'post_title',
        'post_excerpt',
        'post_status',
        'post_name',
        'post_type'
    ];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function taxonomies()
    {
        return $this->belongsToMany(Taxonomy::class, 'term_relationships', 'object_id', 'term_taxonomy_id');
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function author()
    {
        return $this->belongsTo(User::class, 'post_author');
    }

    /**
     * @param $type
     * @return mixed
     */
    public function type($type)
    {
        return $this->where('post_type', $type);
    }

    /**
     * @param array $types
     * @return mixed
     */
    public function typeIn(array $types)
    {
        return $this->whereIn('post_type', $types);
    }

    /**
     * @param $slug
     * @return mixed
     */
    public function slug($slug)
    {
        return $this->where('post_name', $slug);
    }


    public function newEloquentBuilder($query)
    {
        return new PostBuilder($query);
    }


    public function newQuery()
    {
        return $this->postType ?
            parent::newQuery()->type($this->postType) :
            parent::newQuery();
    }

    //old version
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
