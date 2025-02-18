<?php

namespace App\Http\Controllers;

use App\Models\Domain;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class DomainController extends Controller
{
    public function store(Request $request)
    {
        $site = app('site');

        $validated = $request->validate([
            'name' => 'required|string|unique:domains,name',
            'custom_domain' => 'nullable|string|unique:domains,custom_domain'
        ]);

        $domain = $site->domains()->create([
            'name' => $validated['name'],
            'custom_domain' => $validated['custom_domain'],
            'is_active' => true,
            'user_id' => auth()->id(),
        ]);

        return redirect()
            ->route('app.sites.edit', $site)
            ->with('success', 'Domain added successfully');
    }

    public function update(Request $request, Domain $domain)
    {
        $this->authorize('update', $domain);

        $validated = $request->validate([
            'custom_domain' => [
                'nullable',
                'string',
                'max:255',
                Rule::unique('domains')->ignore($domain->id),
            ],
            'page_id' => 'exists:pages,id',
            'is_active' => 'boolean',
        ]);

        $domain->update($validated);

        return response()->json($domain);
    }

    public function create()
    {
        $site = app('site');

        return view('app.domains.create', [
            'site' => $site
        ]);
    }


}
