<?php

declare(strict_types=1);

namespace App\ContentBlocks;

class FeaturesGridBlock extends BaseBlock
{
    public function identifier(): string
    {
        return 'features-grid';
    }

    public function name(): string
    {
        return 'Features Grid';
    }

    public function view(): string
    {
        return 'content-blocks.features-grid';
    }

    public function fields(): array
    {
        return [
            'title' => [
                'type' => 'text',
                'label' => 'Section Title',
                'required' => false,
            ],
            'features' => [
                'type' => 'repeater',
                'label' => 'Features',
                'fields' => [
                    'icon' => ['type' => 'text', 'label' => 'Icon Name'],
                    'title' => ['type' => 'text', 'label' => 'Feature Title'],
                    'description' => ['type' => 'textarea', 'label' => 'Description'],
                ],
            ],
        ];
    }
}
