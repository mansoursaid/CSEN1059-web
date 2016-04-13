<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{

    protected $fillable = [
        'read', 'messsage', 'user_id'
    ];

    protected $table = 'notifications';


    public function user()
    {
        return $this->belongsTo('App\User');
    }


}
