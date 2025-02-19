<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $page->meta_title ?? $page->title }} - {{ config('app.name') }}</title>
    <meta name="description" content="{{ $page->meta_description }}">

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-white">
<!-- Header -->
<header class="border-b">
    <nav class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <a href="/" class="flex items-center text-xl font-semibold text-gray-800">
                    {{ config('app.name') }}
                </a>
            </div>
        </div>
    </nav>
</header>

<!-- Breadcrumbs -->
@if(str_contains($page->full_slug, '/'))
    <div class="bg-gray-50 border-b">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="py-3">
                <nav class="flex" aria-label="Breadcrumb">
                    <ol class="flex items-center space-x-4">
                        <li>
                            <a href="/home" class="text-gray-400 hover:text-gray-500">Home</a>
                        </li>
                        @foreach(explode('/', $page->full_slug) as $i => $slug)
                            <li>
                                <div class="flex items-center">
                                    <svg class="flex-shrink-0 h-5 w-5 text-gray-300" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M5.555 17.776l8-16 .894.448-8 16-.894-.448z" />
                                    </svg>
                                    @if($i == count(explode('/', $page->full_slug)) - 1)
                                        <span class="ml-4 text-gray-500">{{ $page->title }}</span>
                                    @else
                                        <a href="/{{ $slug }}" class="ml-4 text-gray-500 hover:text-gray-700">
                                            {{ ucfirst($slug) }}
                                        </a>
                                    @endif
                                </div>
                            </li>
                        @endforeach
                    </ol>
                </nav>
            </div>
        </div>
    </div>
@endif

<!-- Main Content -->
<main class="relative">
    @if($page->featured_image)
        <div class="absolute inset-0 h-96">
            <img
                src="{{ Storage::url($page->featured_image) }}"
                alt="{{ $page->title }}"
                class="w-full h-full object-cover"
            >
            <div class="absolute inset-0 bg-black/50"></div>
        </div>
    @endif

    <div class="relative {{ $page->featured_image ? 'pt-96' : '' }}">
        {!! $page->renderContent() !!}
    </div>

    <!-- Child Pages (if any) -->
    @if($page->children->count() > 0)
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-16 border-t pt-8">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">Related Pages</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($page->children as $childPage)
                    <a href="/{{ $childPage->slug }}" class="block group">
                        <div class="border rounded-lg overflow-hidden shadow-sm hover:shadow-md transition-shadow">
                            @if($childPage->featured_image)
                                <img
                                    src="{{ Storage::url($childPage->featured_image) }}"
                                    alt="{{ $childPage->title }}"
                                    class="w-full h-48 object-cover"
                                >
                            @endif
                            <div class="p-6">
                                <h3 class="text-xl font-semibold text-gray-900 group-hover:text-blue-600">
                                    {{ $childPage->title }}
                                </h3>
                                @if($childPage->meta_description)
                                    <p class="mt-2 text-gray-600">
                                        {{ Str::limit($childPage->meta_description, 120) }}
                                    </p>
                                @endif
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    @endif
</main>

<!-- Footer -->
<footer class="bg-gray-50 border-t mt-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="text-center text-gray-500">
            <p>&copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
        </div>
    </div>
</footer>
</body>
</html>
