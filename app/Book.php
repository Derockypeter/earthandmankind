<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = [
        'name', 'description', 'image', 'path'
    ];

    public function language()
    {
        return $this->belongsTo(\App\Language::class);
    }
}
