<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Referral extends Model
{
    protected $fillable = [
        "referee_id", "user_id"
    ];


    public function referee()
    {
        return $this->hasMany(User::class, 'referee_id');
    }
}
