<!-- Title Input -->
<div class="bg-white rounded-lg shadow-sm p-6">
    <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Page Title</label>
    <input
        type="text"
        id="title"
        name="title"
        value="{{ old('title', $page->title) }}"
        class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('title') border-red-500 @enderror"
        placeholder="Enter page title"
        required
    >
</div>

<!-- Content Blocks -->
<div id="content-blocks" class="space-y-4">
    @foreach($page->content ?? [] as $index => $block)
        @include('app.pages.partials.blocks.' . Str::kebab(class_basename($block['type'])), [
            'block' => $block,
            'index' => $index
        ])
    @endforeach
</div>

<!-- Add Block Button -->
<button
    type="button"
    onclick="showBlockSelector()"
    class="w-full py-4 border-2 border-dashed border-gray-300 rounded-lg text-gray-600 hover:border-gray-400 hover:text-gray-700"
>
    Add Content Block
</button>
