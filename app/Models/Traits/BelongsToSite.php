<?php

declare(strict_types=1);

namespace App\Models\Traits;

use App\Models\Scopes\SiteScope;
use App\Models\Site;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Query\Builder;

/**
 * @mixin Model
 * @mixin Builder
 */
trait BelongsToSite
{
    public static function bootBelongsToSite(): void
    {
        static::addGlobalScope(new SiteScope);
    }

    public function site(): BelongsTo
    {
        return $this->belongsTo(Site::class);
    }

    // Helper method to temporarily disable site scope
    public function withoutSiteScope(callable $callback)
    {
        return static::withoutGlobalScope(SiteScope::class)->$callback();
    }
}
