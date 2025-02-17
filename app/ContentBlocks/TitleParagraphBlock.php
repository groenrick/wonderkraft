<?php

declare(strict_types=1);

namespace App\ContentBlocks;

use Illuminate\Contracts\View\Factory as ViewFactory;

class TitleParagraphBlock extends BaseBlock
{
    public function __construct(ViewFactory $viewFactory)
    {
        parent::__construct($viewFactory);
    }

    public function identifier(): string
    {
        return 'title-paragraph';
    }

    public function name(): string
    {
        return 'Title & Paragraph';
    }

    public function view(): string
    {
        return 'content-blocks.title-paragraph';
    }

    public function fields(): array
    {
        return [
            'title' => [
                'type' => 'text',
                'label' => 'Title',
                'required' => true,
            ],
            'paragraph' => [
                'type' => 'textarea',
                'label' => 'Paragraph',
                'required' => true,
            ],
        ];
    }
}
