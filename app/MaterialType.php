<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MaterialType extends Model
{
    /**
     * @var string[]
     */
    protected $fillable=[
        "name",
        "task_id",
        "parent_id",
        "description",
        "status"
    ];

    /**
     * @return BelongsTo
     */
    public function parent(): BelongsTo
    {
        return $this->belongsTo(MaterialType::class,'parent_id');
    }

    /**
     * @return BelongsTo
     * Project task
     */
    public function task(): BelongsTo
    {
        return $this->belongsTo(Task::class);
    }

}
