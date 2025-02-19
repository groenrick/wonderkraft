<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Domain extends Model
{
    protected $fillable = [
        'name',
        'custom_domain',
        'site_id',
        'is_primary',
        'is_active',
        'user_id',
    ];

    protected $casts = [
        'is_primary' => 'boolean',
        'is_active' => 'boolean',
    ];

    public function site(): BelongsTo
    {
        return $this->belongsTo(Site::class);
    }

    public function getFullDomainAttribute(): string
    {
        return $this->custom_domain ?? "{$this->name}.wonderkraft.online";
    }
}
