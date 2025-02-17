<?php

declare(strict_types=1);

namespace App\ContentBlocks;

use Illuminate\Contracts\View\Factory as ViewFactory;

class TestimonialsBlock extends BaseBlock
{
    public function identifier(): string
    {
        return 'testimonials';
    }

    public function name(): string
    {
        return 'Testimonials';
    }public function view(): string
{
    return 'content-blocks.testimonials';
}

    public function fields(): array
    {
        return [
            'title' => [
                'type' => 'text',
                'label' => 'Section Title',
            ],
            'style' => [
                'type' => 'select',
                'label' => 'Display Style',
                'options' => [
                    'grid' => 'Grid',
                    'slider' => 'Slider'
                ]
            ],
            'testimonials' => [
                'type' => 'repeater',
                'label' => 'Testimonials',
                'fields' => [
                    'quote' => ['type' => 'textarea', 'label' => 'Quote'],
                    'author' => ['type' => 'text', 'label' => 'Author Name'],
                    'position' => ['type' => 'text', 'label' => 'Position/Company'],
                    'avatar' => ['type' => 'image', 'label' => 'Author Avatar']
                ]
            ]
        ];
    }
}
