<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Groups
 * @package App
 */
class Groups extends Model
{
    /**
     * Mass-assign fields.
     *
     * @var array
     */
    protected $fillable = ['selector', 'sub_heading', 'heading', 'description'];

    /**
     * Hidden fields.
     *
     * @var array
     */
    protected $hidden = ['created_at', 'updated_at'];

    /**
     * Scope a query to only get the group selected by his selector.
     * ----
     * USAGE: $group = \App\Groups::getGroup('<your group>')->get();
     * QUERY: SELECT * FROM Groups WHERE selector = <your group>;
     *
     * @param  void   $query the query statement in the eloquent builder.
     * @param  string $group the group selector in the database.
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeGetGroup($query, $group)
    {
        return $query->where('selector', $group);
    }
}
