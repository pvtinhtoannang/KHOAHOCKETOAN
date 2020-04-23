<?php

namespace App;

use App\Builder\TaxonomyBuilder;
use Illuminate\Database\Eloquent\Model;

class Taxonomy extends Model
{
    /**
     * @var string
     */
    protected $table = 'term_taxonomy';

    /**
     * @var string
     */
    protected $primaryKey = 'term_taxonomy_id';

    /**
     * @var array
     */
//    protected $with = ['term'];

    /**
     * @var bool
     */
    public $timestamps = false;


    public function term()
    {
        return $this->belongsTo(Term::class, 'term_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function parent()
    {
        return $this->belongsTo(Taxonomy::class, 'parent');
    }

    public function tax($taxonomy)
    {
        return $this->where('taxonomy', $taxonomy);
    }

    public function parent_id($parent_id)
    {
        return $this->where('parent', $parent_id);
    }

    /**
     * @param \Illuminate\Database\Query\Builder $query
     * @return TaxonomyBuilder
     */
    public function newEloquentBuilder($query)
    {
        return new TaxonomyBuilder($query);
    }

    /**
     * @return TaxonomyBuilder
     */
    public function newQuery()
    {
        return isset($this->taxonomy) && $this->taxonomy ?
            parent::newQuery()->where('taxonomy', $this->taxonomy) :
            parent::newQuery();
    }

    //old version
    function add_new_term_taxonomy($term_id = null, $taxonomy = null, $description = null, $parent = null)
    {
        return $this->create(['term_id' => $term_id, 'taxonomy' => $taxonomy, 'description' => $description, 'parent' => $parent, 'count' => 0]);
    }
}
