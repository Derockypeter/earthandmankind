<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Featured extends Model
{
    protected $fillable = [
        'featured', 'post_id'
    ];

    public function post()
    {
        return $this->belongsTo(\App\Post::class);
    }
}
