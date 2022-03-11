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
        "documents",
        "comments",
        "description"
    ];
    public function users() {
        return $this->belongsToMany(User::class);
    }
    public function equipments() {
        return $this->hasMany(EquipmentInventory::class)->with(["equipmentType","equipmentRequired"]);
    }
    public function materials() {
        return $this->hasMany(MaterialInventory::class)->with(["materialClass","materialType",'materialRequired']);
    }
}
