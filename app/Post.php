<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'body', 'title', 'status', 'category_id', 'image_id'
    ];
    protected $dates = ['created_at', 'updated_at'];
    
    // Relationship for post and image
    public function images()
    {
        return $this->hasMany(Image::class);
    }
}
