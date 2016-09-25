<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Rental
 * @package App
 */
class Rental extends Model
{
    /**
     * MAss-assign fields
     *
     * @var array
     */
    protected $fillable = [];

    /**
     * Hidden fields
     *
     * @var array
     */
    protected $hidden = [];

    /**
     * Status relation to indicate the rental status.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function status()
    {
        return $this->belongsTo('App\Status');
    }
}
