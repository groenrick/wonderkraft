<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Models\Scopes\SiteScope;
use App\Services\ContentBlockService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PageController extends Controller
{
    public function index(
        Factory $viewFactory,
        Request $request,
    ): View
    {
        // Start with root pages (no parent)
        $query = Page::query()
            ->with(['children'])
            ->withCount('children')
            ->whereNull('parent_id');

        // Apply status filter
        if ($request->has('status')) {
            $query->where('status', $request->status);
        }

        // Apply search
        if ($request->has('search')) {
            $search = $request->search;
            // When searching, we want to search all pages, not just root pages
            $query = Page::query()
                ->with(['author', 'children'])
                ->withCount('children')
                ->where(function ($q) use ($search) {
                    $q->where('title', 'like', "%{$search}%")
                        ->orWhere('slug', 'like', "%{$search}%")
                        ->orWhere('content', 'like', "%{$search}%");
                });
        }

        // Helper function to calculate depth
        $addDepthAttribute = function ($collection, $depth = 0) use (&$addDepthAttribute) {
            return $collection->map(function ($page) use ($depth, $addDepthAttribute) {
                $page->depth = $depth;
                if ($page->relationLoaded('children') && $page->children->count() > 0) {
                    $page->children = $addDepthAttribute($page->children, $depth + 1);
                }
                return $page;
            });
        };

        // Get counts for filter badges
        $publishedCount = Page::where('status', 'published')->count();
        $draftCount = Page::where('status', 'draft')->count();

        // Get pages and transform to include depth
        $pages = $query->latest('updated_at')->get();

        // If not searching, build the hierarchy
        if (!$request->has('search')) {
            $pages = $addDepthAttribute($pages);
            // Flatten the hierarchy for display if needed
            $pages = $this->flattenPageHierarchy($pages);
        } else {
            // For search results, just add depth based on direct parent
            $pages = $addDepthAttribute($pages);
        }

        // Convert to pagination
        $perPage = 20;
        $currentPage = request()->get('page', 1);
        $pagedData = collect($pages)->slice(($currentPage - 1) * $perPage, $perPage);
        $pages = new \Illuminate\Pagination\LengthAwarePaginator(
            $pagedData,
            count($pages),
            $perPage,
            $currentPage,
            ['path' => request()->url()],
        );

        return view('app.pages.index', compact('pages', 'publishedCount', 'draftCount'));
    }

    private function flattenPageHierarchy($pages, &$result = null)
    {
        if ($result === null) {
            $result = collect();
        }

        foreach ($pages as $page) {
            $result->push($page);
            if ($page->relationLoaded('children') && $page->children->count() > 0) {
                $this->flattenPageHierarchy($page->children, $result);
            }
        }

        return $result;
    }

    public function create(
        Factory $viewFactory,
        ContentBlockService $contentBlockService,
    ): View {
        $page = new Page();
        $pages = Page::withoutGlobalScope(SiteScope::class)->where('status', 'published')->get();
        $blocks = $contentBlockService->getBlocksForJavaScript();

        return $viewFactory->make('app.pages.form', [
            'page' => $page,
            'pages' => $pages,
            'blocks' => $blocks,
            'isNewPage' => true,
        ]);
    }

    public function store(Request $request)
    {
        // Validate the request
        $validated = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'slug' => 'nullable|max:255|unique:pages,slug',
            'template' => 'nullable|string|in:default,full-width,landing-page',
            'parent_id' => 'nullable|exists:pages,id',
            'meta_title' => 'nullable|max:255',
            'meta_description' => 'nullable|max:255',
            'featured_image' => 'nullable|image|max:10240', // 10MB max
            'status' => 'required|in:draft,published',
        ]);

        // Generate slug if not provided
        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['title']);
        }

        // Handle featured image upload
        if ($request->hasFile('featured_image')) {
            $path = $request->file('featured_image')->store('pages/featured', 'public');
            $validated['featured_image'] = $path;
        }

        try {
            // Create the page
            $page = app('site')->pages()->create([
                'title' => $validated['title'],
                'slug' => trim($validated['slug'], '/'),
                'content' => $validated['content'],
                'template' => $validated['template'] ?? 'default',
                'parent_id' => $validated['parent_id'],
                'meta_title' => $validated['meta_title'] ?? $validated['title'],
                'meta_description' => $validated['meta_description'],
                'featured_image' => $validated['featured_image'] ?? null,
                'status' => $validated['status'],
            ]);

            return redirect()
                ->route('app.pages.edit', $page)
                ->with('success', 'Page created successfully');

        } catch (\Exception $e) {
            // If featured image was uploaded, remove it
            if (isset($path)) {
                Storage::disk('public')->delete($path);
            }

            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Failed to create page: ' . $e->getMessage());
        }
    }

    public function edit(
        Factory $viewFactory,
        ContentBlockService $contentBlockService,
        Page $page,
    ): View {
        $pages = app('site')->pages()->where('id', '!=', $page->id)
            ->where('status', 'published')
            ->get();
        $blocks = $contentBlockService->getBlocksForJavaScript();

        return $viewFactory->make('app.pages.form', [
            'page' => $page,
            'pages' => $pages,
            'blocks' => $blocks,
            'isNewPage' => false,
        ]);
    }

    public function update(Request $request, Page $page)
    {
        // Validate the request
        $validated = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'slug' => 'required|max:255|unique:pages,slug,' . $page->id,
            'template' => 'nullable|string|in:default,full-width,landing-page',
            'parent_id' => [
                'nullable',
                'exists:pages,id',
                function ($attribute, $value, $fail) use ($page) {
                    if ($value == $page->id) {
                        $fail('A page cannot be its own parent.');
                    }
                },
            ],
            'meta_title' => 'nullable|max:255',
            'meta_description' => 'nullable|max:255',
            'featured_image' => 'nullable|image|max:10240', // 10MB max
            'status' => 'required|in:draft,published',
            'remove_featured_image' => 'nullable|boolean',
        ]);

        try {
            // Handle featured image
            if ($request->boolean('remove_featured_image')) {
                if ($page->featured_image) {
                    Storage::disk('public')->delete($page->featured_image);
                }
                $validated['featured_image'] = null;
            } elseif ($request->hasFile('featured_image')) {
                // Delete old image if exists
                if ($page->featured_image) {
                    Storage::disk('public')->delete($page->featured_image);
                }
                $validated['featured_image'] = $request->file('featured_image')
                    ->store('pages/featured', 'public');
            }

            // Update the page
            $page->update([
                'title' => $validated['title'],
                'slug' => trim($validated['slug'], '/'),
                'content' => $validated['content'],
                'template' => $validated['template'] ?? 'default',
                'parent_id' => $validated['parent_id'],
                'meta_title' => $validated['meta_title'] ?? $validated['title'],
                'meta_description' => $validated['meta_description'],
                'featured_image' => $validated['featured_image'] ?? $page->featured_image,
                'status' => $validated['status'],
            ]);

            return redirect()
                ->route('pages.edit', $page)
                ->with('success', 'Page updated successfully');

        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Failed to update page: ' . $e->getMessage());
        }
    }

    public function destroy(Page $page)
    {
        try {
            // Delete featured image if exists
            if ($page->featured_image) {
                Storage::disk('public')->delete($page->featured_image);
            }

            $page->delete();

            return redirect()
                ->route('app    .pages.index')
                ->with('success', 'Page deleted successfully');

        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Failed to delete page: ' . $e->getMessage());
        }
    }
}
