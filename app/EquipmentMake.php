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

    public function equipmentTypes(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(EquipmentType::class);
    }
}
