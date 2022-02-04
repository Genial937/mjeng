<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Airtime extends Model
{
    protected $fillable=[
        "payment_id",
        "request_id",
        "amount",
        "phone",
        "recipient",
        "discount",
        "status",
        "status_description"
    ];

    public function payment(){
        return $this->belongsTo(Payment::class)->with('user');
    }

}
