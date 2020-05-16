<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PremiumUser extends Model
{
    protected $fillable = [
        'user_id', 'amount', 'status'
    ];
}
