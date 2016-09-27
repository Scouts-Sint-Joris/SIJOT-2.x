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
}
