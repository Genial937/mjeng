<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubCounty extends Model
{
    protected $fillable=['name','county_id'];
    public function county()
    {
        return $this->belongsTo(County::class);
    }
    public function users()
    {
        return $this->hasMany(Users::class);
    }
}
