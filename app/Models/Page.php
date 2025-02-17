<?php

namespace App\Models;

use App\Services\ContentBlockService;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;

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
        'user_id'
    ];

    protected $casts = [
        'parent_id' => 'integer',
        'user_id' => 'integer',
        'content' => 'array',
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
}
