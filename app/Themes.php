<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Themes
 * @package App
 */
class Themes extends Model
{
    /**
     * Mass-assign fields
     *
     * @var array
     */
    protected $fillable = ['name', 'class'];
}
