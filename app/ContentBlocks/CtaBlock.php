<?php

declare(strict_types=1);

namespace App\ContentBlocks;

class CtaBlock extends BaseBlock
{
    public function identifier(): string
    {
        return 'cta';
    }

    public function name(): string
    {
        return 'Call to Action';
    }
    public function view(): string
    {
        return 'content-blocks.cta';
    }
    public function fields(): array
    {
        return [
            'title' => [
                'type' => 'text',
                'label' => 'CTA Title',
                'required' => true,
            ],
            'description' => [
                'type' => 'textarea',
                'label' => 'Description',
            ],
            'button_text' => [
                'type' => 'text',
                'label' => 'Button Text',
            ],
            'button_url' => [
                'type' => 'text',
                'label' => 'Button URL',
            ],
            'background_color' => [
                'type' => 'select',
                'label' => 'Background Color',
                'options' => [
                    'white' => 'White',
                    'gray' => 'Gray',
                    'primary' => 'Primary Color',
                ]
            ]
        ];
    }
}
