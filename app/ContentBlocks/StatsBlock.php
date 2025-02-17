<?php

declare(strict_types=1);

namespace App\ContentBlocks;

use Illuminate\Contracts\View\Factory as ViewFactory;

class StatsBlock extends BaseBlock
{
    public function identifier(): string
    {
        return 'stats';
    }

    public function name(): string
    {
        return 'Statistics';
    }
    public function view(): string
    {
        return 'content-blocks.stats';
    }
    public function fields(): array
    {
        return [
            'title' => [
                'type' => 'text',
                'label' => 'Section Title',
            ],
            'stats' => [
                'type' => 'repeater',
                'label' => 'Statistics',
                'fields' => [
                    'value' => ['type' => 'text', 'label' => 'Value'],
                    'label' => ['type' => 'text', 'label' => 'Label'],
                    'prefix' => ['type' => 'text', 'label' => 'Prefix'],
                    'suffix' => ['type' => 'text', 'label' => 'Suffix']
                ]
            ]
        ];
    }
}
