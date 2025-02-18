<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Site;

class ScopeAdminToSite
{
    public function handle(Request $request, Closure $next)
    {
        $selectedSiteId = session('selected_site_id');

        if (!$selectedSiteId) {
            // If no site is selected, get the user's first site
            $site = auth()->user()->sites()->first();

            if (!$site) {
                return redirect()->route('app.sites.create')
                    ->with('info', 'Please create your first site');
            }

            session(['selected_site_id' => $site->id]);
            $selectedSiteId = $site->id;
        }

        // Bind the selected site to the container
        app()->instance('site', Site::find($selectedSiteId));

        return $next($request);
    }
}
