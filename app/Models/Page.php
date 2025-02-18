<?php

namespace App\Models;

use App\Models\Traits\BelongsToSite;
use App\Services\ContentBlockService;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Page extends Model
{
    use HasFactory;
    use BelongsToSite;

    protected $fillable = [
        'title',
        'slug',
        'content',
        'template',
        'parent_id',
        'meta_title',
        'meta_description',
        'featured_image',
        'status',
        'user_id',
		'site_id',
        'is_homepage',
    ];

    protected $casts = [
        'parent_id' => 'integer',
        'user_id' => 'integer',
        'content' => 'array',
        'is_homepage' => 'boolean',
    ];

    // Parent-child relationship
    public function children()
    {
        return $this->hasMany(Page::class, 'parent_id');
    }

    public function parent()
    {
        return $this->belongsTo(Page::class, 'parent_id');
    }

    // Get full slug including parent slugs
    public function getFullSlugAttribute()
    {
        $slugs = collect([]);
        $page = $this;

        while ($page) {
            $slugs->prepend($page->slug);
            $page = $page->parent;
        }

        return $slugs->join('/');
    }

    public function renderBlocks()
    {
        if (!is_array($this->content)) {
            return '';
        }

        $service = app(ContentBlockService::class);
        $html = '';

        foreach ($this->content as $block) {
            if ($blockType = $service->getBlock($block['type'])) {
                $html .= $blockType->render($block['data']);
            }
        }

        return $html;
    }

    public function renderContent()
    {
        if (!is_array($this->content)) {
            return '';
        }

        $service = app(ContentBlockService::class);
        $html = '';

        foreach ($this->content as $block) {
            if ($blockInstance = $service->getBlock($block['type'])) {
                $html .= $blockInstance->render($block['data']);
            }
        }

        return $html;
    }

    public function domains()
    {
        return $this->hasMany(Domain::class);
    }

    public function site(): BelongsTo
    {
        return $this->belongsTo(Site::class);
    }


    // Get the full URL for this page
    public function getUrlAttribute(): string
    {
        if ($this->is_homepage) {
            return $this->site->primaryDomain->full_domain;
        }

        return $this->site->primaryDomain->full_domain . '/' . $this->slug;
    }
}
