<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class EquipmentInventory extends Model
{
    /**
     * @var string[]
     */
    protected $fillable=[
        "reg_no",
        "business_id",
        "equipment_type_id",
        "equipment_model_id",
        "plate_no",
        "yom",
        "axel",
        "tw",
        "gw",
        "description",
        "ownership",
        "fuel_type",
        "engine_capacity",
        "status",
        "images",
        "comment",
    ];

    /**
     * @return BelongsTo
     * This Equipment model
     */
    public function equipmentModel(): BelongsTo
    {
        return $this->belongsTo(EquipmentModel::class)->with("equipmentMake");
    }
    /**
     * @return BelongsTo
     * This Equipment type
     */
    public function equipmentType(): BelongsTo
    {
        return $this->belongsTo(EquipmentType::class)->with("equipmentMakes");
    }
    /**
     * @return BelongsTo
     * This User type vendor who owns the equipment
     */
    public function business(): BelongsTo
    {
        return $this->belongsTo(Business::class);
    }
    /**
     * @return BelongsToMany
     * This User type vendor who owns the equipment
     */
    public function equipmentRequired(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(EquipmentRequired::class);
    }
}
