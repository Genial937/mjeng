<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Withdraw extends Model
{
    protected $fillable=[
        "user_id",
        "amount",
        "fees",
        "receipt",
        "status",
        "method",
        "description",
        "type"
    ];
    public function user(){
        return $this->belongsTo(User::class);
    }
}
