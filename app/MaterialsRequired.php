<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MaterialsRequired extends Model
{
    protected $fillable=[
        "site_id",
        "task_id",
        "material_type_id",
        "material_class_id",
        "quantity_required",
        "quantity_required_unit",
        "quantity_required_per_day",
        "quantity_required_per_day_unit",
        "currency",
        "lease_rates",
        "lease_modality",
        "payment_term_desc",
        "cess"
    ];
    /**
     * @return BelongsTo
     */
    public function site(): BelongsTo
    {
        return $this->belongsTo(Site::class);
    }
    /**
     * @return BelongsTo
     */
    public function task(): BelongsTo
    {
        return $this->belongsTo(Task::class);
    }
    /**
     * @return BelongsTo
     */
    public function materialType(): BelongsTo
    {
        return $this->belongsTo(MaterialType::class);
    }

    /**
     * @return BelongsTo
     */
    public function classification(): BelongsTo
    {
        return $this->belongsTo(MaterialClass::class,'material_class_id');
    }
    public function materialInventory(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(MaterialInventory::class)
            ->with(["materialType","materialClass","business"=> function ($query) {
                $query->select('id', 'name');
            }]);
    }
}
