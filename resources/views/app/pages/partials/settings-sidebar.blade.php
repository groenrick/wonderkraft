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
            value="{{ old('slug', $page->slug) }}"
            class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('slug') border-red-500 @enderror"
            placeholder="page-url-slug"
        >
    </div>

    <!-- Template -->
    <div class="mb-4">
        <label for="template" class="block text-sm font-medium text-gray-700 mb-2">Template</label>
        <select id="template" name="template" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            <option value="default" {{ old('template', $page->template) == 'default' ? 'selected' : '' }}>Default Template</option>
            <option value="full-width" {{ old('template', $page->template) == 'full-width' ? 'selected' : '' }}>Full Width</option>
            <option value="landing-page" {{ old('template', $page->template) == 'landing-page' ? 'selected' : '' }}>Landing Page</option>
        </select>
    </div>

    <!-- Parent Page -->
    <div>
        <label for="parent_id" class="block text-sm font-medium text-gray-700 mb-2">Parent Page</label>
        <select id="parent_id" name="parent_id" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            <option value="">None</option>
            @foreach($pages as $parentPage)
                <option value="{{ $parentPage->id }}" {{ old('parent_id', $page->parent_id) == $parentPage->id ? 'selected' : '' }}>
                    {{ $parentPage->title }}
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
            value="{{ old('meta_title', $page->meta_title) }}"
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
        >{{ old('meta_description', $page->meta_description) }}</textarea>
    </div>

    <!-- Featured Image -->
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-2">Featured Image</label>
        @if($page->featured_image)
            <div class="mb-2">
                <img src="{{ asset($page->featured_image) }}" alt="" class="w-full rounded-lg">
            </div>
        @endif
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
