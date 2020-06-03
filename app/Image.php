<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable = [
        'imagename', 'image'
    ];

    // Relationship for post and image
    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
