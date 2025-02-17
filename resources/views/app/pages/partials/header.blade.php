<div class="flex justify-between items-center mb-8">
    <div>
        <h1 class="text-2xl font-semibold text-gray-800">{{ $isNewPage ? 'Create New Page' : 'Edit Page' }}</h1>
        <p class="mt-1 text-gray-600">{{ $isNewPage ? 'Add a new page to your website' : 'Update your page content' }}</p>
    </div>
    <div class="flex gap-3">
        @if($isNewPage || $page->status === 'draft')
            <button type="submit" name="status" value="draft" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                Save Changes
            </button>
            <button type="submit" name="status" value="published" class="px-4 py-2 text-gray-700 bg-white border rounded-lg hover:bg-gray-50">
                Save and Publish
            </button>
        @else
            <button type="submit" name="status" value="published" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                Save Changes
            </button>
            <button type="submit" name="status" value="draft" class="px-4 py-2 text-gray-700 bg-white border rounded-lg hover:bg-gray-50">
                Save as Draft
            </button>
        @endif
    </div>
</div>
