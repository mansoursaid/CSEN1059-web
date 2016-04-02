<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invitation extends Model
{
    protected $fillable = [
        'status',
    ];

    protected $table = 'invitations';

    public function created_by()
    {
        return $this->belongsTo('App\User');
    }

    public function user_invited()
    {
        return $this->belongsTo('App\User');
    }

    public function ticket()
    {
        return $this->belongsTo('App\Ticket');
    }
}
