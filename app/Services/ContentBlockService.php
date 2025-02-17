<?php

declare(strict_types=1);

namespace App\Services;

use Illuminate\Contracts\View\Factory as ViewFactory;

class ContentBlockService
{
    protected array $blocks = [];
    protected array $blockMap = [];
    protected ViewFactory $viewFactory;

    public function __construct(ViewFactory $viewFactory)
    {
        $this->viewFactory = $viewFactory;
    }

    public function register(string $blockClass)
    {
        $block = new $blockClass($this->viewFactory);
        $this->blocks[$blockClass] = $block;
        $this->blockMap[$block->identifier()] = $blockClass;
    }

    public function getBlocks(): array
    {
        return $this->blocks;
    }

    public function getBlock(string $type)
    {
        return $this->blocks[$type] ?? null;
    }

    public function getBlockClass(string $identifier): ?string
    {
        return $this->blockMap[$identifier] ?? null;
    }

    public function getBlocksForJavaScript(): array
    {
        return collect($this->blocks)->map(function($block) {
            return [
                'identifier' => $block->identifier(),
                'name' => $block->name(),
                'class' => get_class($block)
            ];
        })->values()->toArray();
    }
}
