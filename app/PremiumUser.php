<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PremiumUser extends Model
{
    protected $fillable = [
        'user_id', 'amount', 'status'
    ];
     /**
     * A payment belongs to a user
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
