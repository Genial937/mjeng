<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MaterialInventory extends Model
{
    protected $fillable=[
        "reg_no",
        "business_id",
        "material_type_id",
        "material_class_id",
        "ownership",
        "description",
        "comment",
        "status"
    ];


    /**
     * @return BelongsTo
     * This Material model
     */
    public function materialClass(): BelongsTo
    {
        return $this->belongsTo(MaterialClass::class);
    }
    /**
     * @return BelongsTo
     * This Equipment type
     */
    public function materialType(): BelongsTo
    {
        return $this->belongsTo(MaterialType::class);
    }
    /**
     * @return BelongsTo
     * This User type vendor who owns the equipment
     */
    public function business(): BelongsTo
    {
        return $this->belongsTo(Business::class);
    }
}
