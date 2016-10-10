<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Tags
 * @package App
 */
class Tags extends Model
{
    /**
     * Mass-assign fields.
     *
     * @var array
     */
    protected $fillable = ['name', 'class'];

    /**
     * Connect the tags to the news items.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function news()
    {
        return $this->belongsToMany('App\News')
            ->withTimestamps();
    }
}
