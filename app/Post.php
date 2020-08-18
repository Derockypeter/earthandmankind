<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'body', 'title', 'status', 'language_id'
    ];
    protected $dates = ['created_at', 'updated_at'];
    
    // Relationship for post and comments
    // public function comments()
    // {
    //     return $this->hasMany(\App\Comment::class);
    // }
    public function featured()
    {
        return $this->hasOne(\App\Featured::class);
    }

    public function language()
    {
        return $this->belongsTo(\App\Language::class);
    }

    public function images()
    {
        return $this->hasMany(Image::class);
    }
}
