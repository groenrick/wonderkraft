<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Models\Scopes\SiteScope;
use App\Models\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class AppController extends Controller
{
    public function index(
        Factory $viewFactory,
    ): View
    {
        $site = app('site');

        // Get page statistics for the current site
        $totalPages = $site->pages()->count();
        $publishedPages = $site->pages()->where('status', 'published')->count();
        $draftPages = $site->pages()->where('status', 'draft')->count();
        $totalUsers = User::count();

        // Get last updated timestamp for this site
        $lastUpdated = $site->pages()->latest('updated_at')->first()?->updated_at;

        // Get recent pages for this site
        $recentPages = $site->pages()
            ->latest('updated_at')
            ->take(5)
            ->get();

        // Get view statistics for this site
        $totalViews = $site->pages()->sum('view_count');
        $popularPages = $site->pages()
            ->orderBy('view_count', 'desc')
            ->take(5)
            ->get();

        return $viewFactory->make('app.dashboard.show', compact(
            'totalPages',
            'publishedPages',
            'draftPages',
            'totalUsers',
            'lastUpdated',
            'recentPages',
            'totalViews',
            'popularPages'
        ));
    }
}
