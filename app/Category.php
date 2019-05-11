<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'id', 'name', 'description',
    ];

    public function comments()
    {
        return $this->hasMany('App\Comment');
    }
    public function posts()
    {
        return $this->hasMany('App\Post');
    }
}
