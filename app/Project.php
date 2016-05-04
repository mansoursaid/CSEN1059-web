<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'name', 'description', 'created_by',
    ];

    protected $table = 'projects';

    public function users()
    {
        return $this->belongsToMany('App\User')->withTimestamps();
    }
}
