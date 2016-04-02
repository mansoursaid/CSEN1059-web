<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $fillable = [
        'tweet_id', 'premium', 'urgency'
    ];

    protected $table = 'tickets';


    public function opened_by()
    {
        return $this->belongsTo('App\User');
    }

    public function assigned_to()
    {
        return $this->belongsTo('App\User');
    }

    public function invitations()
    {
        return $this->hasMany('App\Invitation');
    }

    public function user()
    {
        return $this->belongsToMany('App\User');
    }
}
