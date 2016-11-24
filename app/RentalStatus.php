<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class RentalStatus
 * @package App
 */
class RentalStatus extends Model
{
    /**
     * Mass-assign fields.
     *
     * @var array
     */
    protected $fillable = ['name', 'class'];

    /**
     * Rental -> Status relation.
     *
     * @return mixed
     */
    public function rentals()
    {
        return $this->belongsTo('id', 'status_id');
    }
}
