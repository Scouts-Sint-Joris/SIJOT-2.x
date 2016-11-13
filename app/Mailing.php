<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Mailing
 * @package App
 */
class Mailing extends Model
{
    /**
     * Mass-assign fields. 
     *
     * @var array 
     */
    protected $fillable = ['email', 'name'];

    /**
     * Connect the mailing address to a group.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function mailingGroup()
    {
        return $this->belongsToMany('App\MailingGroups')
            ->withTimestamps();
    }
}
