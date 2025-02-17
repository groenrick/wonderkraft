<div class="content-block bg-white rounded-lg shadow-sm p-6" data-block-index="{{ $index }}">
    <div class="flex justify-between items-center mb-4">
        <h3 class="text-lg font-medium text-gray-800">Title & Paragraph</h3>
        <button type="button" class="text-red-600 hover:text-red-700" onclick="removeBlock({{ $index }})">
            Rfadfdsfsdfsd
        </button>
    </div>

    <input type="hidden" name="content[{{ $index }}][type]" value="{{ $block['type'] }}">

    <div class="space-y-4">
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Title</label>
            <input
                type="text"
                name="content[{{ $index }}][data][title]"
                value="{{ $block['data']['title'] ?? '' }}"
                class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
            >
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Paragraph</label>
            <textarea
                name="content[{{ $index }}][data][paragraph]"
                class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 h-32"
            >{{ $block['data']['paragraph'] ?? '' }}</textarea>
        </div>
    </div>
</div>
