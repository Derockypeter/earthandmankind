<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    protected $fillable = [
        'video', 'preview', 'name', 'section', 'about', 'course_id'
    ];

    /**
     * Relationship for videos and category
     */ 
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    /**
     * Video belongs to a course
     */ 
    public function course()
    {
        return $this->belongsTo(\App\Course::class);
    }
}
