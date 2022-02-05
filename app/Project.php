<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Project extends Model
{
    /**
     * @var string[]
     */
    protected $fillable=[
        "name",
        "description",
        "user_id",
        "start_date",
        "end_date",
        "sub_county_id",
        "status"
    ];

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return BelongsTo
     */
    public function subCounty(): BelongsTo
    {
       return $this->belongsTo(SubCounty::class);
    }
}
