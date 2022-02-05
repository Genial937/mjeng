<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Equipments extends Model
{
    /**
     * @var string[]
     */
    protected $fillable=[
        "reg_no",
        "user_id",
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
        "comment",
    ];

    /**
     * @return BelongsTo
     * This Equipment model
     */
    public function model(): BelongsTo
    {
        return $this->belongsTo(EquipmentModel::class);
    }
    /**
     * @return BelongsTo
     * This Equipment type
     */
    public function type(): BelongsTo
    {
        return $this->belongsTo(EquipmentType::class);
    }
    /**
     * @return BelongsTo
     * This User type vendor who owns the equipment
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
