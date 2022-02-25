<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    /**
     * @var string[]
     */
    protected $fillable=[
        "name",
        "description",
        "status"
    ];
    public function equipmentTypes(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(EquipmentType::class);
    }
    public function materialTypes(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(MaterialType::class);
    }

}
