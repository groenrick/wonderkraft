<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use App\Models\Domain;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;


class ResolveCustomerDomain
{
    public function handle(Request $request, Closure $next)
    {
        $host = $request->getHost();

        // Extract subdomain from *.wonderkraft.online
        if (str_ends_with($host, config('app.domains.customer'))) {
            $subdomain = explode('.', $host)[0];
            $domain = Domain::where('name', $subdomain)
                ->where('is_active', true)
                ->with('site') // Only load site first
                ->first();
        } else {
            // Check for custom domain
            $domain = Domain::where('custom_domain', $host)
                ->where('is_active', true)
                ->with('site') // Only load site first
                ->first();
        }

        if (!$domain) {
            abort(404);
        }

        // Bind the site and domain to the container
        // Instead of App::singleton, just store the actual objects
        app()->instance('site', $domain->site);
        app()->instance('domain', $domain);

        // Now load the pages
        $domain->load('site.pages'); // The scope will work now because site is bound

        // Also store in request for easier access in the current request lifecycle
        $request->merge([
            'site' => $domain->site,
            'domain' => $domain
        ]);

        return $next($request);
    }
}
