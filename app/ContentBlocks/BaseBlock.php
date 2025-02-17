<?php

declare(strict_types=1);

namespace App\ContentBlocks;

use Illuminate\Contracts\View\Factory as ViewFactory;

abstract class BaseBlock
{
    protected ViewFactory $viewFactory;

    public function __construct(ViewFactory $viewFactory)
    {
        $this->viewFactory = $viewFactory;
    }

    abstract public function name(): string;
    abstract public function identifier(): string;
    abstract public function view(): string;
    abstract public function fields(): array;

    public function render($data): \Illuminate\Contracts\View\View
    {
        return $this->viewFactory->make($this->view(), ['data' => $data]);
    }
}
