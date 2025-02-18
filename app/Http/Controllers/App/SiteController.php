<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Models\Scopes\SiteScope;
use App\Models\Site;
use App\Models\User;
use App\Services\ContentBlockService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class SiteController extends Controller
{
    public function index()
    {
        $sites = auth()->user()->sites()
            ->withCount('pages')
            ->latest()
            ->get();

        return view('app.sites.index', compact('sites'));
    }

    public function create()
    {
        return view('app.sites.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $site = auth()->user()->sites()->create($validated);

        session(['selected_site_id' => $site->id]);

        return redirect()->route('app.sites.index')
            ->with('success', 'Site created successfully');
    }

    public function switchSite(Site $site)
    {
        if (!auth()->user()->sites->contains($site->id)) {
            abort(403);
        }
        session(['selected_site_id' => $site->id]);

        return back()->with('success', "Switched to {$site->name}");
    }

    public function edit(Site $site)
    {
        // Authorization check
        if ($site->user_id !== auth()->id()) {
            abort(403);
        }

        return view('app.sites.edit', compact('site'));
    }

    public function update(Request $request, Site $site)
    {
        // Authorization check
        if ($site->user_id !== auth()->id()) {
            abort(403);
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'theme' => 'required|string|in:default,modern,minimal',
            'timezone' => 'required|string|timezone',
            'primary_domain_id' => 'required|exists:domains,id'
        ]);

        $site->update($validated);

        return redirect()
            ->route('app.sites.index')
            ->with('success', 'Site updated successfully');
    }

    public function destroy(Site $site)
    {
        // Authorization check
        if ($site->user_id !== auth()->id()) {
            abort(403);
        }

        $site->delete();

        return redirect()
            ->route('app.sites.index')
            ->with('success', 'Site deleted successfully');
    }
}
