<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'id',
        'name',
        'content',
        'category_id',
        'file',
    ];

    public function category()
    {
        return $this->belongsTo('App\Category');
    }
    public function comments()
    {
        return $this->hasMany('App\Comment');
    }
}
