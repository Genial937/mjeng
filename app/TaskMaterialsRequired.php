<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TaskMaterialsRequired extends Model
{
    protected $fillable=[
        "material_type_id",
        "material_class_id",
        "quantity",
        "quantity_per_day",
        "quantity_metric_unit",
        "currency",
        "lease_modality",
        "modality_value",
        "cess",
        "description"
    ];

    /**
     * @return BelongsTo
     */
    public function type(): BelongsTo
    {
        return $this->belongsTo(MaterialType::class);
    }

    /**
     * @return BelongsTo
     */
    public function classification(): BelongsTo
    {
        return $this->belongsTo(MaterialClass::class);
    }
}
