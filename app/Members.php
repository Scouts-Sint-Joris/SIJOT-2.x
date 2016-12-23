<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Members extends Model
{
    /**
     * Mass-assign fields.
     *
     * @var array
     */
    protected $fillable = [];

    /**
     * Member -> Country relation.
     *
     * @return belongsTo relationship.
     */
    public function country()
    {
        return $this->belongsTo();
    }

    /**
     * User -> Member relationship.
     *
     * This is needed to connect the members. To Logins. 
     *
     * @return belongToMany relation.
     */
    public function parents()
    {
        return $this->belongToMany();
    }
}
