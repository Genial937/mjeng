<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Auth\Passwords\CanResetPassword;
use Zizaco\Entrust\Traits\EntrustUserTrait;

class User extends Authenticatable implements JWTSubject
{
   use canResetPassword, EntrustUserTrait;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        "customer_code",
        'firstname',
        'middlename',
        'surname',
        'phone',
        'email',
        'password',
        'status',
        "referral_code",
        "doc_type",
        "doc_no",
        "sub_county_id",
        "notes",
        "village",
        "user_type"
    ];
    protected $hidden = [
        'password', 'remember_token'
    ];
    /**
     * Add a mutator to ensure hashed passwords
     */
    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = bcrypt($password);
    }
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }
    public function subcounty()
    {
        return $this->belongsTo(SubCounty::class,'sub_county_id','id')->with("county");
    }
    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
    public function withdrawals()
    {
        return $this->hasMany(Withdraw::class);
    }
    public function airtimes()
    {
        return $this->hasMany(Airtime::class);
    }
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }
}
