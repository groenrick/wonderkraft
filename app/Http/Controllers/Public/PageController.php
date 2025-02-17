<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Jobs\TrackPageView;
use App\Models\Page;
use Illuminate\Contracts\Bus\Dispatcher;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PageController extends Controller
{
    public function __construct(

        private readonly Dispatcher $dispatcher,
    )
    {
    }

    public function show(
        Request $request,
        string $slug = '',
    )
    {
        $page = Page::where('slug', $slug)
            ->where('status', 'published')
            ->with(['children' => function($query) {
                $query->where('status', 'published');
            }])
            ->firstOrFail();

        $this->dispatcher->dispatch(new TrackPageView(
            $page,
            $request->userAgent(),
            $request->ip()
        ));

        return view('public.pages.show', compact('page'));
    }
}
