<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['created_at', 'deleted_at', 'start_time', 'end_time', 'date', 'title', 'description'];
    
    /**
     * Mass-assign fields 
     *
     * @var array 
     */ 
    protected $fillable = ['start_time', 'end_time', 'date', 'title', 'description'];
    
    /**
     * Get the affected groups for this activity. 
     * 
     * @return mixed
     */
    public function groups() 
    {
        return $this->belongsToMany('App\Groups'); 
    }
}
