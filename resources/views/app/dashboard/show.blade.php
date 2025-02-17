@extends('app.layouts.app')

@section('main')
    <!-- Main Content -->
    <main class="ml-64 pt-16 min-h-screen">
        <div class="p-8">
            <div class="flex justify-between items-center mb-8">
                <div>
                    <h1 class="text-2xl font-semibold text-gray-800">Dashboard</h1>
                    <p class="mt-1 text-gray-600">Welcome back, {{ auth()->user()?->name }}</p>
                </div>
            </div>

            <!-- Stats Grid -->
            <div class="grid gap-6 mb-8 md:grid-cols-2 xl:grid-cols-4">
                <!-- Total Pages -->
                <div class="p-6 bg-white rounded-lg shadow-sm">
                    <div class="flex items-center">
                        <div class="p-3 text-blue-500 bg-blue-100 rounded-full">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                        </div>
                        <div class="ml-4">
                            <h2 class="text-sm font-medium text-gray-600">Total Pages</h2>
                            <div class="flex items-center">
                                <p class="text-2xl font-semibold text-gray-700">{{ $totalPages }}</p>
                                <span class="ml-2 text-sm text-gray-500">({{ $publishedPages }} published)</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Draft Pages -->
                <div class="p-6 bg-white rounded-lg shadow-sm">
                    <div class="flex items-center">
                        <div class="p-3 text-yellow-500 bg-yellow-100 rounded-full">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                            </svg>
                        </div>
                        <div class="ml-4">
                            <h2 class="text-sm font-medium text-gray-600">Draft Pages</h2>
                            <p class="text-2xl font-semibold text-gray-700">{{ $draftPages }}</p>
                        </div>
                    </div>
                </div>

                <!-- Users -->
                <div class="p-6 bg-white rounded-lg shadow-sm">
                    <div class="flex items-center">
                        <div class="p-3 text-green-500 bg-green-100 rounded-full">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                        </div>
                        <div class="ml-4">
                            <h2 class="text-sm font-medium text-gray-600">Total Users</h2>
                            <p class="text-2xl font-semibold text-gray-700">{{ $totalUsers }}</p>
                        </div>
                    </div>
                </div>

                <!-- Last Updated -->
                <div class="p-6 bg-white rounded-lg shadow-sm">
                    <div class="flex items-center">
                        <div class="p-3 text-purple-500 bg-purple-100 rounded-full">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div class="ml-4">
                            <h2 class="text-sm font-medium text-gray-600">Last Updated</h2>
                            <p class="text-2xl font-semibold text-gray-700">
                                @if($lastUpdated)
                                    {{ $lastUpdated->diffForHumans() }}
                                @else
                                    Never
                                @endif
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Popular Pages Card -->
            <div class="bg-white rounded-lg shadow-sm">
                <div class="px-6 py-4 border-b">
                    <h2 class="text-lg font-semibold text-gray-800">Most Viewed Pages</h2>
                </div>
                <div class="px-6">
                    @if($popularPages->count() > 0)
                        <div class="divide-y">
                            @foreach($popularPages as $page)
                                <div class="py-4 flex items-center justify-between">
                                    <div class="flex items-center">
                                        <div>
                                            <a href="{{ route('app.pages.edit', $page) }}" class="font-medium text-blue-600 hover:text-blue-700">
                                                {{ $page->title }}
                                            </a>
                                            <p class="text-sm text-gray-500">
                                                {{ number_format($page->view_count) }} views
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>

{{--            <!-- Recent Pages -->--}}
{{--            <div class="bg-white rounded-lg shadow-sm">--}}
{{--                <div class="px-6 py-4 border-b">--}}
{{--                    <h2 class="text-lg font-semibold text-gray-800">Recently Updated Pages</h2>--}}
{{--                </div>--}}
{{--                <div class="px-6">--}}
{{--                    @if($recentPages->count() > 0)--}}
{{--                        <div class="divide-y">--}}
{{--                            @foreach($recentPages as $page)--}}
{{--                                <div class="py-4 flex items-center justify-between">--}}
{{--                                    <div class="flex items-center">--}}
{{--                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">--}}
{{--                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />--}}
{{--                                        </svg>--}}
{{--                                        <div>--}}
{{--                                            <a href="{{ route('app.pages.edit', $page) }}" class="font-medium text-blue-600 hover:text-blue-700">--}}
{{--                                                {{ $page->title }}--}}
{{--                                            </a>--}}
{{--                                            <p class="text-sm text-gray-500">--}}
{{--                                                Updated {{ $page->updated_at->diffForHumans() }} by {{ $page->author?->name }}--}}
{{--                                            </p>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $page->status === 'published' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">--}}
{{--                                    {{ ucfirst($page->status) }}--}}
{{--                                </span>--}}
{{--                                </div>--}}
{{--                            @endforeach--}}
{{--                        </div>--}}
{{--                    @else--}}
{{--                        <div class="text-center text-gray-500 py-4">--}}
{{--                            No pages found--}}
{{--                        </div>--}}
{{--                    @endif--}}
{{--                </div>--}}
{{--            </div>--}}
        </div>
    </main>
@endsection
