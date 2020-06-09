<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    protected $fillable = ['language'];

    public function post()
    {
        return $this->hasOne(\App\Post::class);
    }
    public function bible()
    {
        return $this->hasOne(\App\Book::class);
    }
}
