<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MaterialClass extends Model
{
    /**
     * @var string[]
     */
    protected $fillable=[
        "material_type_id",
        "name",
        "description",
        "status"
    ];

    /**
     * @return BelongsTo
     */
    public function materialType(): BelongsTo
    {
        return $this->belongsTo(MaterialType::class);
    }
}
