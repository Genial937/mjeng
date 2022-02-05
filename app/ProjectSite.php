<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProjectSite extends Model
{
    /**
     * @var string[]
     */
    protected $fillable=[
        "project_id",
        "name",
        "description",
        "status"
    ];

    /**
     * @return BelongsTo
     */
    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }
}
