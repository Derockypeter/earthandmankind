<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = [
        'coursename', 'category_id', 'description', 'requirements',
        'about', 'language', 'to_learn', 'image'
    ];
    /**
     * A coursetitle have many videos
     */
    public function videos()
    {
        return $this->hasMany(\App\Video::class);
    }

    /**
     * A course title for a category
     */
    public function category() 
    {
        return $this->belongsTo(\App\Category::class);
    }
}
