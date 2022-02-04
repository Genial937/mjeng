<?php
/**
 * Created by PhpStorm.
 * User: JAMES K MWANGI
 * Date: 26/09/2020
 * Time: 11:45
 */

namespace App;


use Zizaco\Entrust\EntrustRole;

class Role extends EntrustRole
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        "name", "display_name","description"
    ];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }
}

