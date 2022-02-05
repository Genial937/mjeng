<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SystemLogs extends Model
{
    protected $fillable=[
        'user_id',
        "ip",
        "url",
        "method",
        "request_body",
        "response"
    ];
}
