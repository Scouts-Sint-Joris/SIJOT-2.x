<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class NewsLetter
 * @package App
 */
class NewsLetter extends Model
{
    /**
     * Mass-assign fields
     *
     * @var array
     */
    protected $fillable = ['email', 'code'];
}
