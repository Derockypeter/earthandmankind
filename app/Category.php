<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'categoryName', 'catImage'
    ];
    public function course()
    {
        return $this->hasOne(Course::class);
    }
}
