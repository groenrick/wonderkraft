<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PageView extends Model
{
    protected $fillable = [
        'page_id',
        'user_agent',
        'ip_address',
        'viewed_at',
    ];
}
