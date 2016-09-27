<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rental extends Model
{
    /**
     * Set the attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['end_date', 'start_date'];

    /**
     * Mass assign-fields.
     *
     * @var array
     */
    protected $fillable = ['start_date', 'end_date', 'group', 'phone_number', 'email'];

    /**
     * Hidden fields.
     *
     * @var array
     */
    protected $hidden = ['updated_at', 'created_at'];

    /**
     * Format the timestamp format
     *
     * @param  string $date The start time from the form
     * @return string
     */
    public function setStartDateAttribute($date)
    {
        // Use with Carbon instance:
        // -------
        // Carbon::createFromFormat('H:i', $date)->format('H:i');
        return $this->attributes['start_date'] = strtotime(str_replace('/', '-', $date));
    }

    /**
     * Format the timestamp format
     *
     * @param  string $date The start time from the form
     * @return string
     */
    public function setEndDateAttribute($date)
    {
        // Use with Carbon instance:
        // -------
        // Carbon::createFromFormat('H:i', $date)->format('H:i');
        return $this->attributes['end_date'] = strtotime(str_replace('/', '-', $date));
    }

}
