<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Models\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class AppController extends Controller
{
    public function index(
        Factory $viewFactory,
    ): View
    {
        // Get page statistics
        $totalPages = Page::count();
        $publishedPages = Page::where('status', 'published')->count();
        $draftPages = Page::where('status', 'draft')->count();
        $totalUsers = User::count();

        // Get last updated timestamp
        $lastUpdated = Page::latest('updated_at')->first()?->updated_at;

        // Get recent pages
        $recentPages = Page::query()//with('author')
            ->latest('updated_at')
            ->take(5)
            ->get();

        // Get view statistics
        $totalViews = Page::sum('view_count');
        $popularPages = Page::orderBy('view_count', 'desc')
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
