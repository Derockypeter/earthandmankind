<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ImageGallery extends Model
{
    protected $fillable = [
        'desc', 'name', 'tags'
    ];
}
