<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function subCounty(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
       return $this->belongsTo(SubCounty::class);
    }
}
