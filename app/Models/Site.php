<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Site extends Model
{
    protected $fillable = [
        'name',
        'user_id',
        'primary_domain_id',
        'settings',
    ];

    protected $casts = [
        'settings' => 'json',
    ];

    protected $withCount = ['pages', 'domains'];

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($site) {
            $site->pages()->delete();
        });
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function domains(): HasMany
    {
        return $this->hasMany(Domain::class);
    }

    public function pages(): HasMany
    {
        return $this->hasMany(Page::class);
    }

    public function primaryDomain(): BelongsTo
    {
        return $this->belongsTo(Domain::class, 'primary_domain_id');
    }
}
