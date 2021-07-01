<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tour extends Model
{
    protected $fillable = ['country', 'state', 'stateRadioStation', 'programTime', 'period', 'programDate'];
}
