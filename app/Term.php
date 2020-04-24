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
     * @var integer
     */
    protected $slugAlias = 1;

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

    public function slugGenerator($slug = null)
    {
        if ($this->slug($slug)->first() == null) {
            return $slug;
        } else {
            $newSlug = $slug . '-' . $this->slugAlias++;
            return $this->slugGenerator($newSlug);
        }
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
