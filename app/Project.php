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
        "business_id",
        "start_date",
        "end_date",
        "sub_county_id",
        "status"
    ];

    /**
     * @return BelongsTo
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
}
