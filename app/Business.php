<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Business extends Model
{
    protected $fillable =[
        "business_code",
        "name",
        "email",
        "phone",
        "country",
        "city",
        "address",
        "status",
        "type",
        "description"
    ];
    public function users() {
        return $this->belongsToMany(User::class);
    }

}