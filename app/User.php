<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Cache;
use Spatie\Permission\Traits\HasRoles;

/**
 * Class User
 * @package App
 */
class User extends Authenticatable
{
    // Notifiable = Trait for using the notification module.
    use Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'password', 'theme'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    /**
     * Check if the user is logged in. 
     * --------
     * USAGE: auth()->user()->isOnline();
     *
     * @return boolean
     */
    public function isOnline()
    {
        return Cache::has('user-is-online-' . $this->id);
    }

    public function isActive() {
        return in_array('active', $this->permissions()->get()->map(function ($p) {return $p->name;}));
    }
}
