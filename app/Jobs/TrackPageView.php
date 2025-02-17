<?php

namespace App\Jobs;

use App\Models\Page;
use App\Models\PageView;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class TrackPageView implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(
        protected Page $page,
        protected ?string $userAgent,
        protected ?string $ipAddress
    ) {}

    public function handle(): void
    {
        PageView::create([
            'page_id' => $this->page->id,
            'user_agent' => $this->userAgent,
            'ip_address' => $this->ipAddress,
            'viewed_at' => now(),
        ]);

        // Update the total views counter on the page
        $this->page->increment('view_count');
    }
}
