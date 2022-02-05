<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EquipmentType extends Model
{
    /**
     * @var string[]
     */
    protected $fillable=[
        "name",
        "parent_id",
        "task_id",
        "description",
        "status"
    ];

    /**
     * @return BelongsTo
     */
    public function parent(): BelongsTo
    {
        return $this->belongsTo(EquipmentType::class,'parent_id');
    }

    /**
     * @return BelongsTo
     */
    public function task(): BelongsTo
    {
        return $this->belongsTo(Task::class);
    }
}
