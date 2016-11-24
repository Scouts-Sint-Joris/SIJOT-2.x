<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class News
 * @package App
 */
class News extends Model
{
    /**
     * Mass-assign fields
     *
     * @var array
     */
    protected $fillable = ['state', 'user_id', 'heading', 'content'];


    /**
     * Creator relation for getting the creator data.
     *
     * @return mixed
     */
    public function creator()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * Get the tags for a new news item post.
     *
     * @return mixed
     */
    public function tags()
    {
        return $this->belongsToMany('App\Tags')->withTimestamps();
    }
}
