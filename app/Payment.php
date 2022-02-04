<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
  protected $fillable=[
      "user_id",
      "amount",
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
