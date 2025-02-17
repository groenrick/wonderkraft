<div class="content-block bg-white rounded-lg shadow-sm p-6" data-block-index="{{ $index }}">
    <div class="flex justify-between items-center mb-4">
        <h3 class="text-lg font-medium text-gray-800">Hero Section</h3>
        <button type="button" class="text-red-600 hover:text-red-700" onclick="removeBlock({{ $index }})">
            Remove Block
        </button>
    </div>

    <input type="hidden" name="content[{{ $index }}][type]" value="{{ $block['type'] }}">

    <div class="space-y-4">
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Hero Title</label>
            <input
                type="text"
                name="content[{{ $index }}][data][title]"
                value="{{ $block['data']['title'] ?? '' }}"
                class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
            >
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Subtitle</label>
            <input
                type="text"
                name="content[{{ $index }}][data][subtitle]"
                value="{{ $block['data']['subtitle'] ?? '' }}"
                class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
            >
        </div>
        <div>
            @if(isset($block['data']['background_image']))
                <div class="mb-2">
                    <img src="{{ asset($block['data']['background_image']) }}" alt="" class="w-full rounded-lg">
                </div>
            @endif
            <label class="block text-sm font-medium text-gray-700 mb-2">Background Image</label>
            <input
                type="file"
                name="content[{{ $index }}][data][background_image]"
                class="w-full"
                accept="image/*"
            >
        </div>
    </div>
</div>
