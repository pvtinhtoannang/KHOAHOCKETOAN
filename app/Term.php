<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Term extends Model
{
    /**
     * @var string
     */
    protected $table = 'terms';

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @var string
     */
    protected $primaryKey = 'term_id';

    /**
     * @var array
     */
    protected $fillable = [
        'name',
        'slug',
        'term_group'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function taxonomy()
    {
        return $this->hasOne(Taxonomy::class, 'term_id');
    }

    public function slug($slug)
    {
        return $this->where('slug', $slug);
    }

    //old version
    public function posts()
    {
        return $this->belongsToMany('App\Post', 'term_relationships', 'object_id', 'term_taxonomy_id');
    }

    function get_all_term_by_taxonomy($taxonomy = null)
    {
        if ($taxonomy == '') {
            return 0;
        }
        return $this->join('term_taxonomy', 'term_taxonomy.term_id', '=', 'terms.term_id')->where('term_taxonomy.taxonomy', $taxonomy)->get();
    }
}
