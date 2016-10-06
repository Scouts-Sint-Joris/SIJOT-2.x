<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Themes extends Model
{
    /**
     * Mass-assign fields
     *
     * @var array 
     */
    protected $fillable = ['name', 'class'];
}
