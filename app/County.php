<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class County extends Model

{

    protected $fillable=['id','name'];
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function subcounties(){
        return $this->hasMany(SubCounty::class);
    }
}
