<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Audio extends Model
{
    use SoftDeletes;
    protected $fillable = ['name', 'description', 'audio_path', 'language_id', 'cover_image', 'audio_path'];
    public function language()
    {
        return $this->belongsTo(\App\Language::class);
    }

}
