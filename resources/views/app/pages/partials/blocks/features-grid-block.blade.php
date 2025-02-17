<div class="content-block bg-white rounded-lg shadow-sm p-6" data-block-index="{{ $index }}">
    <div class="flex justify-between items-center mb-4">
        <h3 class="text-lg font-medium text-gray-800">Features Grid</h3>
        <button type="button" class="text-red-600 hover:text-red-700" onclick="removeBlock({{ $index }})">
            Remove Block
        </button>
    </div>

    <input type="hidden" name="content[{{ $index }}][type]" value="{{ $block['type'] }}">

    <div class="space-y-4">
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Section Title</label>
            <input
                type="text"
                name="content[{{ $index }}][data][title]"
                value="{{ $block['data']['title'] ?? '' }}"
                class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
            >
        </div>

        <div class="border-t pt-4">
            <label class="block text-sm font-medium text-gray-700 mb-2">Features</label>
            <div class="repeater-items space-y-4">
                @foreach($block['data']['features'] ?? [] as $i => $feature)
                    <div class="repeater-item relative border rounded-lg p-4">
                        <button type="button" onclick="removeRepeaterItem(this)" class="absolute top-2 right-2 text-red-600 hover:text-red-700">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                        <div class="grid gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Icon Name</label>
                                <input
                                    type="text"
                                    name="content[{{ $index }}][data][features][{{ $i }}][icon]"
                                    value="{{ $feature['icon'] ?? '' }}"
                                    class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                >
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Feature Title</label>
                                <input
                                    type="text"
                                    name="content[{{ $index }}][data][features][{{ $i }}][title]"
                                    value="{{ $feature['title'] ?? '' }}"
                                    class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                >
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                                <textarea
                                    name="content[{{ $index }}][data][features][{{ $i }}][description]"
                                    class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                    rows="2"
                                >{{ $feature['description'] ?? '' }}</textarea>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <button
                type="button"
                class="add-item-button mt-4 w-full py-2 border-2 border-dashed border-gray-300 rounded-lg text-gray-600 hover:border-gray-400 hover:text-gray-700"
            >
                Add Feature
            </button>
        </div>
    </div>
</div>
