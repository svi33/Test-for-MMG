<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'id',
        'au​thor',
        'content',
        'created_at',
        'category_id',
        'post_id',
    ];

    public function category()
    {
        return $this->belongsTo('App\Category');
    }
    public function post()
    {
        return $this->belongsTo('App\Post');
    }
}
