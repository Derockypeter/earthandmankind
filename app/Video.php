<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    protected $fillable = [
        'videoName', 'category_id', 'title'
    ];

    // Relationship for videos and category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
