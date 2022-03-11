<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class MaterialInventory extends Model
{
    protected $fillable=[
        "reg_no",
        "business_id",
        "material_type_id",
        "material_class_id",
        "sub_county_id",
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
     * This Material type
     */
    public function materialType(): BelongsTo
    {
        return $this->belongsTo(MaterialType::class);
    }
    /**
     * @return BelongsTo
     *
     */
    public function business(): BelongsTo
    {
        return $this->belongsTo(Business::class);
    }
    /**
     * @return BelongsTo
     */
    public function subCounty(): BelongsTo
    {
        return $this->belongsTo(SubCounty::class)->with("county");
    }
    /**
     * @return BelongsToMany
     * This User type vendor who owns the equipment
     */
    public function materialRequired(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(MaterialsRequired::class);
    }
}
