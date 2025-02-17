<?php

declare(strict_types=1);

namespace App\ContentBlocks;

use Illuminate\Contracts\View\Factory as ViewFactory;

class GalleryBlock extends BaseBlock
{
    public function identifier(): string
    {
        return 'gallery';
    }

    public function name(): string
    {
        return 'Image Gallery';
    }public function view(): string
{
    return 'content-blocks.gallery';
}

    public function fields(): array
    {
        return [
            'title' => [
                'type' => 'text',
                'label' => 'Gallery Title',
            ],
            'columns' => [
                'type' => 'select',
                'label' => 'Columns',
                'options' => [
                    '2' => 'Two',
                    '3' => 'Three',
                    '4' => 'Four'
                ]
            ],
            'images' => [
                'type' => 'repeater',
                'label' => 'Images',
                'fields' => [
                    'image' => ['type' => 'image', 'label' => 'Image'],
                    'caption' => ['type' => 'text', 'label' => 'Caption']
                ]
            ]
        ];
    }
}
