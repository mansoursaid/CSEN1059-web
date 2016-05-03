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
        return $this->belongsToMany('App\Ticket');
    }

    public function projects()
    {
        return $this->belongsToMany('App\Project')->withTimestamps();
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

    public static function strTypeToInt($strType)
    {
        if($strType == 'admin' || $strType == 'Admin' || $strType == 'admins' )
        {
            return '00';
        }
        elseif($strType == 'supervisor' || $strType == 'Supervisor' || $strType == 'supervisors')
        {
            return '01';
        }
        else {
            return '10';
        }
    }

    public static function IntTypeToStr($intType)
    {
        if($intType == 00 )
        {
            return 'Admin';
        }
        elseif($intType == 01)
        {
            return 'Supervisor';
        }
        else {
            return 'Agent';
        }
    }

    public static function getName($id)
    {
        $user = User::find($id);
        return ucfirst($user->name);
    }
}
