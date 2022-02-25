<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
    /**
     * @return HasMany
     * Project task
     */
    public function classifications(): HasMany
    {
        return $this->hasMany(MaterialClass::class);
    }
}
