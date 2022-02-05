<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EquipmentMake extends Model
{
    /**
     * @var string[]
     */
    protected $fillable=[
        "name",
        "description",
        "status"
    ];
}
