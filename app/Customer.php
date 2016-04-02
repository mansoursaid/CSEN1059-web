<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = [
        'email', 'name', 'twitter_handle', 'phone_number'
    ];

    protected $table = 'customers';

    public function tickets()
    {
        return $this->hasMany('App\Ticket');
    }
}
