@extends('app.layouts.app')


@section('main')
    <!-- Main Content -->
    <main class="ml-64 pt-16 min-h-screen">
        <div class="p-8">
            <form action="{{ route('app.pages.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="flex justify-between items-center mb-8">
                    <div>
                        <h1 class="text-2xl font-semibold text-gray-800">Create New Page</h1>
                        <p class="mt-1 text-gray-600">Add a new page to your website</p>
                    </div>
                    <div class="flex gap-3">
                        <button type="submit" name="status" value="draft" class="px-4 py-2 text-gray-700 bg-white border rounded-lg hover:bg-gray-50">
                            Save as Draft
                        </button>
                        <button type="submit" name="status" value="published" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                            Publish Page
                        </button>
                    </div>
                </div>

                <!-- Show validation errors if any -->
                @if ($errors->any())
                    <div class="mb-6 bg-red-50 text-red-700 p-4 rounded-lg">
                        <ul class="list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="grid grid-cols-3 gap-6">
                    <!-- Main Editor Column -->
                    <div class="col-span-2 space-y-6">
                        <!-- Title Input -->
                        <div class="bg-white rounded-lg shadow-sm p-6">
                            <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Page Title</label>
                            <input
                                type="text"
                                id="title"
                                name="title"
                                value="{{ old('title') }}"
                                class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('title') border-red-500 @enderror"
                                placeholder="Enter page title"
                                required
                            >
                        </div>

                        <!-- Content Editor -->
                        <div class="bg-white rounded-lg shadow-sm p-6">
                            <label for="content" class="block text-sm font-medium text-gray-700 mb-2">Content</label>
                            <textarea
                                id="content"
                                name="content"
                                class="w-full h-96 px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('content') border-red-500 @enderror"
                                placeholder="Start writing your content here..."
                                required
                            >{{ old('content') }}</textarea>
                        </div>
                    </div>

                    <!-- Settings Sidebar -->
                    <div class="space-y-6">
                        <!-- Page Settings -->
                        <div class="bg-white rounded-lg shadow-sm p-6">
                            <h3 class="text-lg font-medium text-gray-800 mb-4">Page Settings</h3>

                            <!-- URL Slug -->
                            <div class="mb-4">
                                <label for="slug" class="block text-sm font-medium text-gray-700 mb-2">URL Slug</label>
                                <input
                                    type="text"
                                    id="slug"
                                    name="slug"
                                    value="{{ old('slug') }}"
                                    class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('slug') border-red-500 @enderror"
                                    placeholder="page-url-slug"
                                >
                            </div>

                            <!-- Template -->
                            <div class="mb-4">
                                <label for="template" class="block text-sm font-medium text-gray-700 mb-2">Template</label>
                                <select id="template" name="template" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                    <option value="default" {{ old('template') == 'default' ? 'selected' : '' }}>Default Template</option>
                                    <option value="full-width" {{ old('template') == 'full-width' ? 'selected' : '' }}>Full Width</option>
                                    <option value="landing-page" {{ old('template') == 'landing-page' ? 'selected' : '' }}>Landing Page</option>
                                </select>
                            </div>

                            <!-- Parent Page -->
                            <div>
                                <label for="parent_id" class="block text-sm font-medium text-gray-700 mb-2">Parent Page</label>
                                <select id="parent_id" name="parent_id" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                    <option value="">None</option>
                                    @foreach($pages as $page)
                                        <option value="{{ $page->id }}" {{ old('parent_id') == $page->id ? 'selected' : '' }}>
                                            {{ $page->title }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <!-- SEO Settings -->
                        <div class="bg-white rounded-lg shadow-sm p-6">
                            <h3 class="text-lg font-medium text-gray-800 mb-4">SEO Settings</h3>

                            <!-- Meta Title -->
                            <div class="mb-4">
                                <label for="meta_title" class="block text-sm font-medium text-gray-700 mb-2">Meta Title</label>
                                <input
                                    type="text"
                                    id="meta_title"
                                    name="meta_title"
                                    value="{{ old('meta_title') }}"
                                    class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                    placeholder="SEO title"
                                >
                            </div>

                            <!-- Meta Description -->
                            <div class="mb-4">
                                <label for="meta_description" class="block text-sm font-medium text-gray-700 mb-2">Meta Description</label>
                                <textarea
                                    id="meta_description"
                                    name="meta_description"
                                    class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 h-24 resize-none"
                                    placeholder="Enter meta description"
                                >{{ old('meta_description') }}</textarea>
                            </div>

                            <!-- Featured Image -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Featured Image</label>
                                <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-lg">
                                    <div class="space-y-1 text-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                        <div class="flex text-sm text-gray-600">
                                            <label class="relative cursor-pointer bg-white rounded-md font-medium text-blue-600 hover:text-blue-500 focus-within:outline-none">
                                                <span>Upload a file</span>
                                                <input type="file" name="featured_image" class="sr-only">
                                            </label>
                                            <p class="pl-1">or drag and drop</p>
                                        </div>
                                        <p class="text-xs text-gray-500">PNG, JPG, GIF up to 10MB</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </main>
@endsection
