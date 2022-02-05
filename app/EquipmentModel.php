<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EquipmentModel extends Model
{
    /**
     * @var string[]
     */
    protected $fillable=[
        "equipment_make_id",
        "name",
        "description",
        "status"
    ];

    /**
     * @return BelongsTo
     */
    public function make(): BelongsTo
    {
        return $this->belongsTo(EquipmentMake::class);
    }


}
