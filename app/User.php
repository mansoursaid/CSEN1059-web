<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;


class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'type',
    ];

    protected $table = 'users';

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function opened_tickets()
    {
        return $this->hasMany('App\Tickets');
    }

    public function assigned_to()
    {
        return $this->hasMany('App\Tickets');
    }

    public function created_invitations()
    {
        return $this->hasMany('App\Invitation');
    }

    public function invited_invitations()
    {
        return $this->hasMany('App\Invitation');
    }

    public function tickets()
    {
        return $this->belongsToMany('App\Tickets');
    }

    public function projects()
    {
        return $this->belongsToMany('App\Projects');
    }

    public function notifications()
    {
        return $this->belongsToMany('App\Notification');
    }


    /**
     * Scope a query to only include users of a given type.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOfType($query, $type)
    {
        return $query->where('type', $type);
    }



    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = bcrypt($password);
    }

}
