<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $fillable = [
        'tweet_id', 'premium', 'urgency'
    ];

    protected $table = 'tickets';
}
