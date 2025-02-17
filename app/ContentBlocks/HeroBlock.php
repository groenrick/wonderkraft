<?php

declare(strict_types=1);

namespace App\ContentBlocks;

use Illuminate\Contracts\View\Factory as ViewFactory;

class HeroBlock extends BaseBlock
{
    public function __construct(ViewFactory $viewFactory)
    {
        parent::__construct($viewFactory);
    }

    public function identifier(): string
    {
        return 'hero';
    }

    public function name(): string
    {
        return 'Hero Section';
    }

    public function view(): string
    {
        return 'content-blocks.hero';
    }

    public function fields(): array
    {
        return [
            'title' => [
                'type' => 'text',
                'label' => 'Hero Title',
                'required' => true,
            ],
            'subtitle' => [
                'type' => 'text',
                'label' => 'Subtitle',
                'required' => false,
            ],
            'background_image' => [
                'type' => 'image',
                'label' => 'Background Image',
                'required' => false,
            ],
        ];
    }
}
